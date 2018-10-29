<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Avatar;
use AppBundle\Form\AvatarType;
use AppBundle\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CompteController extends Controller
{
    /**
     * @Route("/compte")
     */
    public function compteAction(Request $request)
    {
                $user_id=$this->getUser()->getId();
        $avatar = new Avatar();
        $form = $this->createForm(AvatarType::class, $avatar);
        $form->handleRequest($request);
        $id_avatar=$this->getUser()->getAvatar();
        $all = $this->getDoctrine()->getRepository('AppBundle:Avatar')->findAll();
        $avataractuel = $this->getDoctrine()->getRepository('AppBundle:Avatar')->findByUser($user_id)[0];
        var_dump($avataractuel);
        //if(!isset($avataractuel)|| sizeof($avataractuel)==0){
        //    $avataractuel="";
        //}
        if ($form->isSubmitted() && $form->isValid()) {
        // $file stores the uploaded PDF file
        /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
        $file = $avatar->getImage();

        // Generate a unique name for the file before saving it
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        // Move the file to the directory where brochures are stored
        $file->move(
            $this->getParameter('image_dir'),
            $fileName
        );

        // Update the 'brochure' property to store the PDF file name
        // instead of its contents

        $avatar->setImage($fileName);

        $avatar->setUser($user_id);
        $this->getUser()->setAvatar($avatar->getId());
        $em = $this->getDoctrine()->getManager();
        $em->persist($this->getUser());
        $em->persist($avatar);
        $em->flush();


        // ... persist the $product variable or any other work
    }
        return $this->render('AppBundle:Compte:compte.html.twig', array(
            'form' => $form->createView(),
            'avatar' =>$avataractuel,
        ));
    }


}
