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
                'label'=> "Quelle catégorie ?",
                'multiple' => true,
                'expanded' => true,
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
            ->add('imageUneFile',VichImageType::class,[
                'label' => 'Image à la une',
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Sélectionnez un fichier '
                ]
            ] )
            ->add('alt', TextType::class, [
                'label'=> 'Référencement image à la une',
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Ajouter des mots-clés',
                ]
            ])
            ->add('imageFile1',VichImageType::class,[
                'label' => 'Téléchagez une image',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Sélectionnez un fichier '
                ]
            ] )
            ->add('alt2', TextType::class, [
                'label'=> 'Référencement image 1',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Ajouter des mots-clés',
                ]
            ])
            ->add('imageFile2',VichImageType::class,[
                'label' => 'Téléchagez une image',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Sélectionnez un fichier '
                ]
            ] )
            ->add('alt3', TextType::class, [
                'label'=> 'Référencement image 2',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Ajouter des mots-clés',
                ]
            ])
            ->add('imageFile3',VichImageType::class,[
                'label' => 'Téléchagez une image',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Sélectionnez un fichier '
                ]
            ] )
            ->add('alt4', TextType::class, [
                'label'=> 'Référencement image 3',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Ajouter des mots-clés',
                ]
            ])
            ->add('imageFile4',VichImageType::class,[
                'label' => 'Téléchagez une image',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Sélectionnez un fichier '
                ]
            ] )
            ->add('alt5', TextType::class, [
                'label'=> 'Référencement image 4',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Ajouter des mots-clés',
                ]
            ])
            ->add('imageFile5',VichImageType::class,[
                'label' => 'Téléchagez une image',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Sélectionnez un fichier '
                ]
            ] )
            ->add('alt6', TextType::class, [
                'label'=> 'Référencement image 5',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Ajouter des mots-clés',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
