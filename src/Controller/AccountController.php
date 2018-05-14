<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccountController extends Controller
{
    /**
     * @Route("/account/login", name="login")
     */
    public function login()
    {
        return $this->render('account/login.html.twig');
    }

     /**
     * @Route("/account/register", name="register")
     */
    public function register()
    {
        return $this->render('account/register.html.twig');
    }

}
