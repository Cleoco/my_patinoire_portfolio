<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Prestation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'=> 'Intitulé de la prestation',
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Ajouter un titre',
                ]
            ])
            ->add('contentLeft', TextareaType::class, [
                'label'=> 'Texte de gauche',
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Ajouter du contenu à gauche…',
                    'class'=>'ckeditor',
                ]
            ])
            ->add('contentRight', TextareaType::class, [
                'label'=> 'Texte de droite',
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Ajouter du contenu à droite…',
                    'class'=>'ckeditor',

                ]
            ])
            ->add('category', EntityType::class, [
                'class'=> Category::class,
                'choice_label'=> 'name',
                'label'=> "Quelle catégorie ?",
                'required'=> true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
