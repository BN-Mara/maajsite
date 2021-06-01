<?php

namespace App\Repository;

use App\Entity\VoteMode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VoteMode|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoteMode|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoteMode[]    findAll()
 * @method VoteMode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoteModeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoteMode::class);
    }

    // /**
    //  * @return VoteMode[] Returns an array of VoteMode objects
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
    public function findOneBySomeField($value): ?VoteMode
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
