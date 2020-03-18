<?php

namespace App\Repository;

use App\Entity\FiltersBlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FiltersBlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method FiltersBlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method FiltersBlog[]    findAll()
 * @method FiltersBlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FiltersBlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FiltersBlog::class);
    }

    // /**
    //  * @return FiltersBlog[] Returns an array of FiltersBlog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FiltersBlog
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
