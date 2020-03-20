<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Filter;
use App\Entity\Article;
use App\Entity\FiltersBlog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create(" ");

           $filter2 = new FiltersBlog();
           $filter2->setName('PRINT');
           $filter2->setImage('print-picto-5e6bc58a14613370035551.svg');
           $manager->persist($filter2);
           
           $filter3 = new FiltersBlog();
           $filter3->setName('MARKETING');
           $filter3->setImage('Groupe179.svg');
           $manager->persist($filter3);
    
           $filter4 = new FiltersBlog();
           $filter4->setName('DESIGN');
           $filter4->setImage('Groupe178.svg');
           $manager->persist($filter4);
    
           $filter5 = new FiltersBlog();
           $filter5->setName('DEV');
           $filter5->setImage('Groupe116.svg');
           $manager->persist($filter5);

        for($j = 1; $j < mt_rand(6,15); $j++){
            $article = new Article();
            $content = '<p>' . join($faker->paragraphs(5),'</p><p>').'</p>';
            $article -> setTitle($faker->sentence())
                     -> setContent($content)
                     -> setCreatedAt($faker->dateTimeBetween('-6 months'))
                     -> setLink($faker->url)
                     -> setSource($faker->url)
                     -> setUpdatedAt($faker->dateTimeBetween('-6 months'));
            $manager->persist($article);
                     
            for($k = 1; $k < mt_rand(4,15); $k++){
                $comment = new Comment();
                $content = '<p>' . join($faker->paragraphs(2),'</p><p>') . '</p>';
    
      
                $days = (new \DateTime())->diff($article->getCreatedAt())->days;
                $comment-> setAuthor($faker->name)
                        -> setContent($content)
                        -> setCreatedAt($faker->dateTimeBetween("-" .  $days . ' days' ))
                        -> setArticle($article)
                        -> setEmail($faker->email)
                        -> setGdprAgreement(true);
                $manager->persist($comment);
    
            }
        }
    



        $manager->flush();
    }
}

