<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Publisher;
use App\Repository\PublisherRepository;
use Symfony\Component\Security\Core\Security;

/**
 * Class PublisherDataProvider
 * @package App\DataProvider
 */
class PublisherDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    use FindOneByOwnerIdTrait;

    /**
     * @var Security
     */
    private $_security;
    /**
     * @var PublisherRepository
     */
    private $_repository;

    /**
     * PublisherDataProvider constructor.
     * @param PublisherRepository $repository
     * @param Security $security
     */
    public function __construct(PublisherRepository $repository, Security $security)
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
        return Publisher::class === $resourceClass;
    }
}