<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Controller\TraverneController;

use AppBundle\Entity\Hero;
use AppBundle\Entity\Ressource;
use AppBundle\Entity\Comptetence;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class TaverneController extends Controller
{


    public function nomCompetence(){
        return array(
            0 => 'Couper du bois',
            1 => 'Faire une quête',
            2 => 'Miner du fer',
            3 => 'Miner du Charbon',
            4 => 'Chasser'
     );
    }
    /**
     * @Route("/creerUnHero")
     */
    public function creerUnHeroAction(Request $request)
    {
        $hero = new Hero();
        //$formBuilder = $this->get('form.factory')->createBuilder('form',$tmp);
        $form = $this->createFormBuilder($hero)
        ->add('nom', TextType::class)
        ->add('enregistrer', SubmitType::class, array('label' => 'Enregistrer'))
        ->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          $hero->setNom($request->request->get('form')['nom']);
          $hero->setNiveau(1);
          $hero->setPointAction(3);
          $hero->setInventaire(array());
          //a rajouter avec id du perso
          $hero->setProprietere($this->getUser()->getId());
          $hero->setPropid((integer)$this->getUser()->getId());
          $em = $this->getDoctrine()->getManager();
          $em->persist($hero); // prépare l'insertion dans la BD
          $em->flush(); // insère dans la BD
          return $this->redirectToRoute("choisirUnHero",array());
    }
        return $this->render('AppBundle:Taverne:creer_un_hero.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/choisirUnHero", name="choisirUnHero")
     */
    public function choisirUnHeroAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $arrayHero = $this->getDoctrine()
          ->getRepository('AppBundle:Hero')
          //->findAll();
          ->findByPropid($id);
          //var_dump($this->getUser()->getId());
          //var_dump($arrayHero[0]);
        return $this->render('AppBundle:Taverne:choisir_un_hero.html.twig',
         array('hero' =>$arrayHero,

        ));
    }
    /**
    * @Route("/jouerUnHero", name="jouerUnHero")
    */
    public function jouerUnHero(Request $request){
        //Je passe pas par Symfony j'ai eu des bug avec leur radio

        if(isset($_POST['hero'])){
                $id =$_POST['hero'];
        }else {
            $id = (integer)$request->request->get('form')['hero'];
            //var_dump($id);
        }
        $bd = $this->getDoctrine();
        $info ="";
        $user_id = $this->getUser()->getId();
        $arrayHero = $bd->getRepository('AppBundle:Hero')->findById($id);
        $hero = $arrayHero[0];
        $niveau = $hero->getNiveau();
        $re = $this->getDoctrine()
            ->getRepository('AppBundle:Ressource')
            ->findById($user_id)[0];

        $comptetence = $bd->getRepository('AppBundle:Comptetence')->findByHero($id);
        $nbCompetence = (integer)sizeof($comptetence);


        $nourrirform = $this->createFormBuilder()
        ->add('hero',HiddenType::class,array('data'=>$id))
        ->add('Envoyer',SubmitType::class,array('label'=>'Nourrir','attr'=>array('class' => 'cooldown')))
        ->getForm();
        $nourrirform->handleRequest($request);
        if($nourrirform->isSubmitted() && $nourrirform->isValid()){
            $nourriture =10;
            if($nourriture >0){
                $hero->setPointAction($hero->getPointAction() + 3);
                $em = $this->getDoctrine()->getManager();
                $em->persist($hero);
                $em->flush();
                $info = "Le hero a mangé, il a désormais plus de point d'action";
            }
        }
        $c = $this->compForm($comptetence,$user_id,$re,$request,$id);
        $achat = $this->achatForm($nbCompetence,$id,$user_id,$request);
        $a = $this->nomCompetence();
        return $this->render('AppBundle:Taverne:jouerUnHero.html.twig',array(
            'hero' => $hero,
            'info' => $info,
            'nourrirform' => $nourrirform->createView(),
            'compname' => $a,
            'comp'=> $comptetence,
            'achat' => $achat->createView(),
            're' => $re,
            'co' =>$c->createView(),
        ));
    }

    public function compForm($comptetence,$user_id,$re,$request,$id){
                $bd = $this->getDoctrine();
        $tmp = array();
        foreach ($comptetence as $key => $value) {
            array_push($tmp,[$value->getNom() => $value->getId()]);
        }
        $compform = $this->createFormBuilder()
        ->add('Comp', ChoiceType::class, array(
            'choices'  => $tmp
        ))
        ->add('hero',HiddenType::class,array('data'=>$id))
        ->add('Envoyer',SubmitType::class,array('label'=>'Acheter'))
        ->getForm();
        $compform->handleRequest($request);
        if(isset($request->request->get('form')['Comp'])){
            //var_dump('achat');
            if ($compform->isSubmitted() && $compform->isValid()){
                $y = $request->request->get('form')['Comp'];
                $comptetence = $bd->getRepository('AppBundle:Comptetence')->findById($y)[0];
                $this->actionSurRessource($comptetence,$id);
            }
        }
        return $compform;
    }

    public function achatForm($nbCompetence,$id,$user_id,$request){
        $achatform = $this->createFormBuilder()
        ->add('Achat', ChoiceType::class, array(
            'choices'  => array(
            'Couper du bois'  => 0,
            'Faire une quête' =>1,
            'Miner du fer' =>2,
            'Miner du Charbon'=>3,
            'Chasser'=>4,
        )))
        ->add('hero',HiddenType::class,array('data'=>$id))
        ->add('Envoyer',SubmitType::class,array('label'=>'Acheter'))
        ->getForm();
        $achatform->handleRequest($request);
        if(isset($request->request->get('form')['Achat'])){
            //var_dump('achat');
        if ($achatform->isSubmitted() && $achatform->isValid()) {
            $re = $this->getDoctrine()
                ->getRepository('AppBundle:Ressource')
                ->findById($user_id)[0];
            if($re->getArgent()>= 100*(integer)$nbCompetence){
                $comp = new Comptetence();
                $id_comp = $request->request->get('form')['Achat'];
                var_dump($id_comp);
                $a = $this->nomCompetence()[$id_comp];
                $comp->setNom($a);
                $comp->setHero($id);

                $re->setArgent($re->getArgent()-100*(integer)$nbCompetence);
                $em = $this->getDoctrine()->getManager();
                $em->persist($comp);
                $em->persist($re);
                $em->flush();
            }
        }
        }
        return $achatform;
    }
    public function prixComptence($nbCompetence){
        return 100*$nbCompetence;
    }
    public function actionSurRessource($comp,$id){
        $bd = $this->getDoctrine();
        $arrayHero = $bd->getRepository('AppBundle:Hero')->findById($id)[0];
        $re = $bd->getRepository('AppBundle:Ressource')->findByProprietere($this->getUser()->getId())[0];
        if(strcmp($comp->getNom(),'Couper du bois')){
            $re->setAcier($re->getAcier()+(1*$comp->getNiveau()));
        }
        else if(strcmp('Faire une quête',$comp->getNom())){
            $re -> setArgent($re->getArgent()+(1*$comp->getNiveau()));

        }
        else if(strcmp('Miner du fer',$comp->getNom())){
            $re -> setFer($re->getFer()+(1*$comp->getNiveau()));
        }
        elseif (strcmp('Miner du Charbon',$comp->getNom())) {
            $re->setCharbon($re->getCharbon()+(1*$comp->getNiveau()));
        }
        else if(strcmp('Chasser',$comp->getNom())){
            $re->setCharbon($re->getNourriture()+(1*$comp->getNiveau()));
        }
        else{
            var_dump('erreur compétence');
        }
        $arrayHero->manger();
        $x = $comp->up();
        $em = $this->getDoctrine()->getManager();
        $em->persist($arrayHero);
        $em->persist($re);
        $em->persist($x);
        $em->flush();

    }

    /*public function achatCompetence($hero,id){
        $comp = new Comptetence();
        $comp->setNom("Couper bois");
    }*/
    /**
    * @Route("/taverne")
    */
    public function taverne(){
        return $this->render('taverne.html.twig',array());
    }

}
