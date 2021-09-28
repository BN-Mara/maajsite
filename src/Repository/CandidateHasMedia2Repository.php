<?php

namespace App\Repository;

use App\Entity\CandidateHasMedia2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CandidateHasMedia2|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidateHasMedia2|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidateHasMedia2[]    findAll()
 * @method CandidateHasMedia2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateHasMedia2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidateHasMedia2::class);
    }

    // /**
    //  * @return CandidateHasMedia2[] Returns an array of CandidateHasMedia2 objects
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
    public function findOneBySomeField($value): ?CandidateHasMedia2
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
