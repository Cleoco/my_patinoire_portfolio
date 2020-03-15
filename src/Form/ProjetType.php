<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class'=> Category::class,
                'choice_label'=> 'name',
                'label'=> "Quelle catégorie ?"
            ])
            ->add('title', TextType::class, [
                'label'=> 'Intitulé du projet',
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Ajouter un titre',
                ]
            ])
            ->add('content', TextareaType::class, [
                'label'=> 'Description',
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Ajouter une présentation',
                    'class'=>'ckeditor',
                ]
            ])
            ->add('fullwidth')
            ->add('imageFile1',VichImageType::class,[
                'label' => 'Téléchagez une image',
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Sélectionnez un fichier '
                ]
            ] )
            ->add('imageFile2',VichImageType::class,[
                'label' => 'Téléchagez une image',
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Sélectionnez un fichier '
                ]
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
