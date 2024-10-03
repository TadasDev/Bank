<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\FormError;

class RegisterController extends AbstractController
{
    #[Route('/security/register', name: 'app_security_register', methods:['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        // Check if form is submitted
        if ($form->isSubmitted()) {
            // Check for existing users first
            $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);

            if ($existingUser) {
                // Add the error directly to the form if the email is already in use
                $form->get('email')->addError(new FormError('This email is already in use.'));
            }

            // Validate the form only if there is no existing user
            if ($form->isValid()) {
                $user->setPassword(
                    $passwordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );

                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('security/login.html.twig');
            }
        }
         // Collect error messages
        $errorMessages = [];
            foreach ($form->getErrors(true, false) as $error) {
                    $errorMessages[] = $error;
        }
        
        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
            'errorMessage' => $errorMessages,
        ]);
    }
}