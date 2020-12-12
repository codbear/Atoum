<?php


namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Component\Security\Core\Security;

/**
 * Class BookDataProvider
 * @package App\DataProvider
 */
class BookDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    use FindOneByOwnerIdTrait;

    /**
     * @var BookRepository
     */
    private $_repository;
    /**
     * @var Security
     */
    private $_security;

    /**
     * BookDataProvider constructor.
     * @param BookRepository $repository
     * @param Security $security
     */
    public function __construct(BookRepository $repository, Security $security)
    {
        $this->_repository = $repository;
        $this->_security = $security;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Book::class === $resourceClass;
    }
}