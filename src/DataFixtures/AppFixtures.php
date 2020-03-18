<?php

namespace App\DataFixtures;

use App\Entity\FiltersBlog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
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

        $manager->flush();
    }
}

