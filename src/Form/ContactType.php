<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Nom*',
                ]
            ])
            ->add('societe', TextType::class, [
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Société',
                ]
            ])
            ->add('email', EmailType::class, [
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'E-mail*',
                    ]
                ])
            ->add('telephone', TextType::class, [
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Téléphone*',
                ]
            ])
            ->add('message', TextareaType::class, [
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Commentaire*',
                ]
            ])
            ->add('gdprAgreement', CheckboxType::class, [
                'required' => true,
                 
            ])
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
