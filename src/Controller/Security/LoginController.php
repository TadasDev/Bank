<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{
    #[Route('/security/login', name: 'app_security_login')]
    public function index(): Response
    {
        return $this->render('security/login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
}
