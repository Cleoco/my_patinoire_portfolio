<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
        ->add('plainPassword',RepeatedType::class,[
            'type'=> PasswordType::class,
            'invalid_message'=> 'Les mots de passe ne sont pas identiques',
            'options'=>['attr'=>['class'=>'passeword-field']],
            'required'=>true,
            'first_options'=>['label'=>'Nouveau mot de passe'],
            'second_options'=>['label'=>'Confirmation du mot de passe'],
            'mapped'=>false,
            'label'=>'Mot de passe',
            'constraints'=>[
                new NotBlank([
                    'message'=> 'Entrez un mot de passe',
                ]),
                new Length([
                    'min'=> 6,
                    'minMessage'=> 'Votre mot de passe est trop court',
                    'max'=>4096,
                ]),
            ],
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
