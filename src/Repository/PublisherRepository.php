<?php

namespace App\Repository;

use App\Entity\Publisher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Publisher|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publisher|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publisher[]    findAll()
 * @method Publisher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublisherRepository extends ServiceEntityRepository implements OwnedEntityRepositoryInterface
{
    /**
     * PublisherRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publisher::class);
    }

    /**
     * @param $ownerId
     * @return Publisher[] Return an array of Publisher objects
     */
    function findByOwnerId($ownerId)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.owner = :val')
            ->setParameter('val', $ownerId)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
