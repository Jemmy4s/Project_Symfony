<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Ressource;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $bd = $this->getDoctrine();
        $id = $this->getUser()->getId();
        $arrayActive = $bd->getRepository('AppBundle:User')
        ->findByIsActive(true);
        $nbUser= $bd->getRepository('AppBundle:User')->findAll();
        $arrayRessources = $bd->getRepository('AppBundle:Ressource')->findByProprietere($id);
        // permette un evenment de pillage de ressource
        //Si j'ai le temps il sera implementer. (:inspiration EVE Online)
        if(sizeof($arrayRessources)==0){
            $re= new Ressource();
            $re->setProprietere($id);
            $em = $this->getDoctrine()->getManager();
            $em->persist($re);
            $em->flush();
        }else{
            $re = $arrayRessources[0];
        }

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'active' => $arrayActive,
            're' =>$re,
            'nbUser'=>sizeof($nbUser),
        ]);
    }
    /**
    * @Route("/start", name="start")
    */
    public function startAction(){
        return $this->render('default/start.html.twig');
    }
}
