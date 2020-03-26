<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Type;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'constraints' => [
                    new Length(['min' => 1, 'max' =>30]),
                    new NotBlank(),
                    new Type(['type'=>'string'])
                ],
                'label'=>false,
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Nom*',
                ]
            ])
            ->add('societe', TextType::class, [
                'constraints' => [
                    new Length(['min' => 1, 'max' =>30]),
                    new Type(['type'=>'string'])
                ],
                'label'=>false,
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Société',
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Length(['min' => 3, 'max' =>30]),
                    new NotBlank(),
                    new Email(),
                    new Type(['type'=>'string'])
                ],
                'label'=>false,
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'E-mail*',
                    ]
                ])
            ->add('telephone', TextType::class, [
                'constraints' => [
                    new Length(['min' => 10, 'max' =>10]),
                    new NotBlank(),
                    new Type(['type'=>'string']),
                    new Positive()
                ],
                'label'=>false,
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Téléphone*',
                ]
            ])
            ->add('message', TextareaType::class, [
                'constraints' => [
                    new Length(['min' => 10, 'max' =>2000]),
                    new Type(['type'=>'string'])
                ],
                'label'=>false,
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Commentaire',
                ]
            ])
            ->add('gprdAgreement', CheckboxType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
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
