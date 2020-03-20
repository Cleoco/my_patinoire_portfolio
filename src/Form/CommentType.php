<?php

namespace App\Form;

use App\Entity\Comment;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', TextType::class, [
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Nom*',
                ]
            ])
            ->add('content', TextareaType::class, [
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Commentaire*',
                ]
            ])
            ->add('email', TextType::class, [
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Email*',
                ]
            ])
            ->add('gdprAgreement', CheckboxType::class, [
                'required' => true,
                 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
