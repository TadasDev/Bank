<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName', TextType::class, [
            'label' => 'First Name',
            'attr' => ['placeholder' => 'Enter your first name'],
            'constraints' => [
                new NotBlank(['message' => 'First name is required.']),
            ],
        ])
        ->add('lastName', TextType::class, [
            'label' => 'Last Name',
            'attr' => ['placeholder' => 'Enter your last name'],
            'constraints' => [
                new NotBlank(['message' => 'Last name is required.']),
            ],
        ])
        ->add('email', EmailType::class, [
            'label' => 'Email',
            'attr' => ['placeholder' => 'Enter your email address'],
            'constraints' => [
                new NotBlank(['message' => 'Email is required.']),
                new Email(['message' => 'Please enter a valid email address.']),
            ],
        ])
        ->add('password', PasswordType::class, [
            'label' => 'Password',
            'attr' => ['placeholder' => 'Enter your password'],
            'constraints' => [
                new NotBlank(['message' => 'Password is required.']),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters long.',
                ]),
            ],
        ]);
    }
            
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
