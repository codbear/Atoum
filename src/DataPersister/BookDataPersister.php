<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Book;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

/**
 * Class BookDataPersister
 * @package App\DataPersister
 */
class BookDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;
    /**
     * @var Request|null
     */
    private $_request;
    /**
     * @var Security
     */
    private $_security;

    /**
     * BookDataPersister constructor.
     * @param EntityManagerInterface $entityManager
     * @param RequestStack $request
     * @param Security $security
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        RequestStack $request,
        Security $security
    ) {
        $this->_entityManager = $entityManager;
        $this->_request = $request->getCurrentRequest();
        $this->_security = $security;
    }

    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Book;
    }

    /**
     * @inheritDoc
     */
    public function persist($data, array $context = [])
    {
        if ($this->_request->getMethod() === 'POST') {
            $data->setCreatedAt(new DateTime());
            $data->setOwner($this->_security->getUser());
        }

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}
