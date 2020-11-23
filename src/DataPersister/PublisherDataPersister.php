<?php

namespace App\DataPersister;

use App\Entity\Publisher;

/**
 * Class PublisherDataPersister
 * @package App\DataPersister
 */
class PublisherDataPersister extends DataPersister
{
    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Publisher;
    }
}
