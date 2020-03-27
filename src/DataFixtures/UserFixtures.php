<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct( UserPasswordEncoderInterface $passwordEncoder) {
    $this ->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // user rôle admin
        $user = new User();
        $pass = $this ->passwordEncoder->encodePassword($user, 'Empowering36130#' );
        $user
        ->setEmail( 'cleo.cosnier@gmail.com' )
        ->setFirstname( 'Cléo' )
        ->setPassword($pass)
        ->setRoles([ 'ROLE_ADMIN' ]);
        $manager->persist($user);

        $manager->flush();
    }
}
