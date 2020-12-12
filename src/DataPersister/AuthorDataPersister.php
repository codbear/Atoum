<?php

namespace App\DataPersister;

use App\Entity\Author;

/**
 * Class AuthorDataPersister
 * @package App\DataPersister
 */
class AuthorDataPersister extends DataPersister
{
    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Author;
    }
}
