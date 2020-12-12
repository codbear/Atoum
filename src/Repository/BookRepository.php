<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    /**
     * BookRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @param $ownerId
     * @return Book[] Return an array of Book objects
     */
    public function findByOwnerId($ownerId)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.owner = :val')
            ->setParameter('val', $ownerId)
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
