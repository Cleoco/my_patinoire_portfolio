<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       // liste pour mon sélecteur de catégories
       $categories = ['TOUT','PRINT','WEB','UX/UI','DEV','CMS'];
       // tableau pour enregistrer chaque objet de type Category
       $tabObjetsCategory = []; 
       // Boucle pour créer autant d'objets que de catégories dans la liste
       foreach($categories as $cat){
           $category = new Category();
           $category->setName($cat);
           $manager->persist($category);
           array_push($tabObjetsCategory,$category);
       }

        $manager->flush();
    }
}
