<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Component\Security\Core\Security;

/**
 * Class AuthorDataProvider
 * @package App\DataProvider
 */
class AuthorDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    use FindOneByOwnerIdTrait;

    /**
     * @var Security
     */
    private $_security;
    /**
     * @var AuthorRepository
     */
    private $_repository;

    /**
     * AuthorDataProvider constructor.
     * @param AuthorRepository $repository
     * @param Security $security
     */
    public function __construct(AuthorRepository $repository, Security $security)
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
        return Author::class === $resourceClass;
    }
}