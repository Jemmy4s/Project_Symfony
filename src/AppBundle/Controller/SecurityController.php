<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

class SecurityController extends Controller
{
  /**
* @Route("/login", name="login")
* @Template()
*/

public function loginAction(Request $request)
{
    $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
}
/**
* @Method({"POST"})
* @Route("/login_check", name="login_check")
*/
public function check()
{
    throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
}

/**
* @Method({"GET"})
* @Route("/logout", name="logout")
*/
public function logout()
{
    throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
}
}
