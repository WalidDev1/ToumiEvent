<?php

namespace App\Repository;

use App\Entity\Res;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Res|null find($id, $lockMode = null, $lockVersion = null)
 * @method Res|null findOneBy(array $criteria, array $orderBy = null)
 * @method Res[]    findAll()
 * @method Res[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Res::class);
    }

    // /**
    //  * @return Res[] Returns an array of Res objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Res
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
