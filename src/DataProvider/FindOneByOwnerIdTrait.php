<?php


namespace App\DataProvider;


/**
 * Trait FindOneByOwnerIdTrait
 * @package App\DataProvider
 */
trait FindOneByOwnerIdTrait
{
    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return mixed
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $ownerId = $this->_security->getUser()->getId();

        return $this->_repository->findByOwnerId($ownerId);
    }
}