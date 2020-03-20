<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\FiltersBlog;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'=> 'Intitulé de l\'article',
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
            ->add('imageFile',VichImageType::class,[
                'label' => 'Téléchagez une image',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Sélectionnez un fichier '
                ]
            ] )
            ->add('link', TextType::class, [
                'label'=> 'Liens',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Ajouter un lien vers un site',
                ]
            ])
            ->add('source', TextType::class, [
                'label'=> 'Liens',
                'required'=> true,
                'attr' => [
                    'placeholder'=> 'Ajouter une source',
                ]
            ])
            ->add('filter', EntityType::class, [
                'class'=> FiltersBlog::class,
                'choice_label'=> 'name',
                'label'=> "Quel filtre ?"
            ])
            ->add('keyWords', TextType::class, [
                'label'=> 'Mots-clés',
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Ajouter des mots-clés pour cet article',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
