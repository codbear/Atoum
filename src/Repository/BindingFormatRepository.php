<?php

namespace App\Repository;

use App\Entity\BindingFormat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BindingFormat|null find($id, $lockMode = null, $lockVersion = null)
 * @method BindingFormat|null findOneBy(array $criteria, array $orderBy = null)
 * @method BindingFormat[]    findAll()
 * @method BindingFormat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BindingFormatRepository extends ServiceEntityRepository
{
    /**
     * BindingFormatRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BindingFormat::class);
    }

    // /**
    //  * @return BindingFormat[] Returns an array of BindingFormat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BindingFormat
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
