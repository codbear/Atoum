<?php

namespace App\Repository;

use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Genre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genre[]    findAll()
 * @method Genre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreRepository extends ServiceEntityRepository implements OwnedEntityRepositoryInterface
{
    /**
     * GenreRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
    }

    /**
     * @param $ownerId
     * @return Genre[] Return an array of Author objects
     */
    public function findByOwnerId($ownerId)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.owner = :val')
            ->setParameter('val', $ownerId)
            ->orderBy('g.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
