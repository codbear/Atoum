<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Genre;
use App\Repository\GenreRepository;
use Symfony\Component\Security\Core\Security;

/**
 * Class GenreDataProvider
 * @package App\DataProvider
 */
class GenreDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    use FindOneByOwnerIdTrait;

    /**
     * @var Security
     */
    private $_security;
    /**
     * @var GenreRepository
     */
    private $_repository;

    /**
     * GenreDataProvider constructor.
     * @param GenreRepository $repository
     * @param Security $security
     */
    public function __construct(GenreRepository $repository, Security $security)
    {
        $this->_repository = $repository;
        $this->_security = $security;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Genre::class === $resourceClass;
    }
}