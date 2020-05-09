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
use Symfony\Component\Validator\Constraints\EqualTo;
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
                    new Length([
                        'min' => 1,
                        'minMessage'=> 'Ce champs doit contenir au minimum {{ limit }} caractères',
                        'max' =>30,
                        'maxMessage'=> 'Ce champs doit contenir au maximum {{ limit }} caractères',]),
                    new NotBlank([
                        'message'=> 'Ce champs ne peut pas être vide',
                    ]),
                    new Type([
                        'type'=>'string',
                        'message'=> 'Ce champs doit contenir uniquement une chaine de caractère',
                        ]),
                ],
                'label'=>false,
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Nom*',
                ]
            ])
            ->add('societe', TextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage'=> 'Ce champs doit contenir au minimum {{ limit }} caractères',
                        'max' =>30,
                        'maxMessage'=> 'Ce champs doit contenir au maximum {{ limit }} caractères',]),
                    new Type([
                        'type'=>'string',
                        'message'=> 'Ce champs doit contenir uniquement une chaine de caractère',
                        ]),
                ],
                'label'=>false,
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Société',
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'minMessage'=> 'Ce champs doit contenir au minimum {{ limit }} caractères',
                        'max' =>30,
                        'maxMessage'=> 'Ce champs doit contenir au maximum {{ limit }} caractères',]),
                    new NotBlank([
                        'message'=> 'Ce champs ne peut pas être vide',
                    ]),
                    new Email([
                        'message'=> 'Cette e-mail n\'est pas valide',
                    ]),
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
                    new Length([
                        'min' => 10,
                        'max' =>10,
                        'exactMessage'=> 'Ce champs doit contenir exactement {{ limit }} caractères',]),
                    new NotBlank([
                        'message'=> 'Ce champs ne peut pas être vide',
                    ]),
                    new Type([
                        'type'=>'string',
                        'message'=> 'Ce champs doit contenir uniquement une chaine de caractère',
                        ]),
                    new Positive([
                        'message'=> 'Ce champs doit contenir un nombre positif',
                    ])
                ],
                'label'=>false,
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Téléphone*',
                ]
            ])
            ->add('message', TextareaType::class, [
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage'=> 'Votre message doit contenir au minimum {{ limit }} caractères',
                        'max' =>2000,
                        'maxMessage'=> 'Votre message doit contenir au maximum {{ limit }} caractères',]),
                    new Type([
                        'type'=>'string',
                        'message'=> 'Ce champs doit contenir uniquement une chaine de caractère',
                        ]),
                ],
                'label'=>false,
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Commentaire',
                ]
            ])
            ->add('gprdAgreement', CheckboxType::class, [
                'constraints' => [
                    new NotBlank([
                        'message'=> 'Ce champs de ne peut pas être vide',
                    ]),
                ],
                'label'=>false,
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
