<?php

namespace App\DataPersister;

use App\Entity\Genre;

/**
 * Class GenreDataPersister
 * @package App\DataPersister
 */
class GenreDataPersister extends DataPersister
{
    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Genre;
    }
}
