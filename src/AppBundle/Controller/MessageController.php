<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Hero;
use AppBundle\Entity\Message;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Form\VarDumper\Cloner\Data;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class MessageController extends Controller
{
    /**
     * @Route("/ecrireMessage",name="ecrireMessage")
     */
    public function ecrireMessageAction(Request $request)
    {
        $bd = $this->getDoctrine();
        $em = $bd->getManager();

        $message = new Message();
        $form = $this->createFormBuilder($message)
        ->add('receveur',TextType::class,array('label' => 'Destinatere' ))
        ->add('Entete',TextType::class)
        ->add('Texte',TextareaType::class)
        ->add('Envoyer',SubmitType::class,array('label'=>'Envoyer'))
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
         $data=$form->getData();
         //var_dump($data);
         $receveur = $request->request->get('form')['receveur'];
         $entete =$request->request->get('form')['Entete'];
         $texte =$request->request->get('form')['Texte'];
         var_dump($receveur);
         $user = $bd ->getRepository('AppBundle:User')
            ->findByUsername($receveur)[0];
            //il y a un seul nom donc pas de pb.
            $id = $user->getId();
          $message->setEntete($entete);
          $message->setTexte($texte);
          $message->setJour(new \DateTime("now"));
          $message->setDate(new \DateTime("now"));
          $message->setHeure(new \DateTime("now"));
          $message->setReceveur($id);
          $message->setEnvoyeur($this->getUser()->getId());

          $em = $this->getDoctrine()->getManager();
          $em->persist($message);
          $em->flush();


          //$message->setLu(fasle);
        }
        return $this->render('AppBundle:Message:ecrire_message.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/lireMessage", name="lireMessage")
     */
    public function lireMessageAction()
    {

        $bd = $this->getDoctrine();
        $id = $this->getUser()->getId();
        $arrayMessage = $bd->getRepository('AppBundle:Message')
        //->findAll();
        ->findByReceveur($id);
        //var_dump($arrayMessage);
        //foreach ($arrayMessage $key => $value) {

            //array_push(,);
        //}
        return $this->render('AppBundle:Message:lire_message.html.twig', array(
            'arrayMessage'=>$arrayMessage,
            'nbMessage' => sizeof($arrayMessage),
        ));
    }

}
