<?php

namespace App\Repository;

use App\Entity\VoteJury;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VoteJury|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoteJury|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoteJury[]    findAll()
 * @method VoteJury[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoteJuryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoteJury::class);
    }

    // /**
    //  * @return VoteJury[] Returns an array of VoteJury objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VoteJury
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
