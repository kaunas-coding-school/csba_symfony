<?php

namespace App\Repository;

use App\Entity\Meniu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Meniu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meniu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meniu[]    findAll()
 * @method Meniu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeniuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meniu::class);
    }

    // /**
    //  * @return Meniu[] Returns an array of Meniu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Meniu
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
