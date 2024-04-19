<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => '-- Saissisez votre email --',
                    'class' => 'form-control my-4'
                ]
            ])
            ->add('password', PasswordType::class, [

                'label' => false,
                'attr' => [
                    'placeholder' => '-- Saissisez votre mot de passe --',
                    'class' => 'form-control my-4'
                ]
            ])
            ->add('firstName', TextType::class,  [
                'label' => false,
                'attr' => [
                    'placeholder' => '-- Saissisez votre Prénom --',
                    'class' => 'form-control my-4'
                ]
            ])
            ->add('lastName', TextType::class,  [
                'label' => false,
                'attr' => [
                    'placeholder' => '-- Saissisez votre email --',
                    'class' => 'form-control my-4'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-warning text-light my-2'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
