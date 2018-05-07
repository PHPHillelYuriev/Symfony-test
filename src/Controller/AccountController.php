<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccountController extends Controller
{
    /**
     * @Route("/account/sign_in", name="sign_in")
     */
    public function sign_in()
    {
        return $this->render('account/sign_in.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

     /**
     * @Route("/account/sign_up", name="sign_up")
     */
    public function sign_up()
    {
        return $this->render('account/sign_up.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

}
