<?php

namespace App\DataPersister;

use App\Entity\Book;
use DateTime;

/**
 * Class BookDataPersister
 * @package App\DataPersister
 */
class BookDataPersister extends DataPersister
{
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
        if ($this->request->getMethod() === 'POST') {
            $data->setCreatedAt(new DateTime());
            $data->setOwner($this->security->getUser());
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}
