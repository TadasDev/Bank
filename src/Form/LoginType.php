<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'label' => 'Email',
            'required' => true,
            'attr' => ['placeholder' => 'Enter your email address']
        ])
        ->add('password', PasswordType::class, [
            'label' => 'Password',
            'required' => true,
            'attr' => ['placeholder' => 'Enter your password']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_token', 
            'csrf_token_id'   => 'authenticate', 
        ]);
    }
    
    public function getBlockPrefix()
    {
        return 'login_form';
    }
}
