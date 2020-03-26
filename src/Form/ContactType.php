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
                'label'=>false,
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Nom*',
                ]
            ])
            ->add('societe', TextType::class, [
                'label'=>false,
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Société',
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=>false,
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'E-mail*',
                    ]
                ])
            ->add('telephone', TextType::class, [
                'label'=>false,
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Téléphone*',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label'=>false,
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Commentaire',
                ]
            ])
            ->add('gprdAgreement', CheckboxType::class, [
                'label'=>'j\'accepte la politique d\'utilisation de mes données personnelles',
                'required' => true,
                 
            ])
            ->add('envoyer', SubmitType::class, [
                'attr'=> [
                    'class' => 'btn btn-secondary btn-4 btn-4c icon-arrow-right'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
