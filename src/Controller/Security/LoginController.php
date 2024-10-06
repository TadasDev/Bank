<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/security/login', name: 'app_security_login', methods: ['POST'])]
    public function login(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $submittedEmail = $form->get('email')->getData();
            $submittedPassword = $form->get('password')->getData();

            $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $submittedEmail]);

            if (!$existingUser) {
                $form->addError(new FormError('This email does not exist.'));
            } else {
                if (!$passwordEncoder->isPasswordValid($existingUser, $submittedPassword)) {
                    $form->addError(new FormError('Incorrect password.'));
                } else {
                    return $this->redirectToRoute('dashboard/main.html.twig');
                }
            }
        }

        return $this->render('security/login.html.twig', [
            'loginForm' => $form,
        ]);
    }
}
