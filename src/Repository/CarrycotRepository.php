<?php

namespace App\Repository;

use App\Entity\Carrycot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Carrycot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carrycot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carrycot[]    findAll()
 * @method Carrycot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarrycotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carrycot::class);
    }

    // /**
    //  * @return Carrycot[] Returns an array of Carrycot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Carrycot
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
