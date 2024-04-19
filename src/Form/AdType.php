<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Category;
use App\Entity\User;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr'=> [
                    'placeholder' => '-- Saisissez un titre --',
                    'class' => 'form-control my-5'
                ]
            ])
            ->add('slug', TextType::class, [
                'label' => false,
                'attr'=> [
                    'placeholder' => '-- Saisissez un slug --',
                    'class' => 'form-control my-5'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr'=> [
                    'class' => ' my-5'
                ]
            ])
            ->add('image', FileType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'my-5'
                ],
                'constraints' => [
                    new File([
                        //'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Vérifiez le format de votre image.',
                    ])
                ],
            ])

            ->add('publishedAt', null, [
                'label' => false,
                'widget' => 'single_text',
                'attr'=> [
                    'class' => 'form-control my-5'
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => false ,
                'choice_label' => 'name',
                'placeholder' => '-- Choisissez une catégorie --',
                'attr' => [
                    'class' => 'form-select my-5'
                ]

            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer mon article',
                'attr' => [
                    'class' => 'btn btn-warning text-light my-5'
                ]
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
