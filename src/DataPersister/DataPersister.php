<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

/**
 * Class DataPersister
 * @package App\DataPersister
 */
class DataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    /**
     * @var Request|null
     */
    protected $request;
    /**
     * @var Security
     */
    protected $security;

    /**
     * DataPersister constructor.
     * @param EntityManagerInterface $entityManager
     * @param RequestStack $request
     * @param Security $security
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        RequestStack $request,
        Security $security
    ) {
        $this->entityManager = $entityManager;
        $this->request = $request->getCurrentRequest();
        $this->security = $security;
    }

    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function persist($data, array $context = [])
    {
        if ($this->request->getMethod() === 'POST') {
            $data->setOwner($this->security->getUser());
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}