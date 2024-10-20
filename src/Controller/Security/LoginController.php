<?php

namespace App\Controller\Security;

use Symfony\Component\HttpFoundation\Request;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/security/login', name: 'app_security_login', methods: ['GET', 'POST'])]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginType::class);    
        $form->handleRequest($request);

        return $this->render('security/login.html.twig', [
            'login_form' => $form,
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/security/logout', name: 'app_security_logout', methods: ['POST'])]
    public function logout(): void
    {
        // Symfony handles logout automatically, this method can be empty.
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
