<?php


namespace App\Repository;


/**
 * Interface RepositoryInterface
 * @package App\Repository
 */
interface OwnedEntityRepositoryInterface
{
    /**
     * @param $ownerId
     * @return mixed
     */
    function findByOwnerId($ownerId);
}