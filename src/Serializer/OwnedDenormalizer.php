<?php


namespace App\Serializer;


use App\Entity\Author;
use App\Entity\Book;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;

/**
 * Class OwnedDenormalizer
 * @package App\Serializer
 */
class OwnedDenormalizer implements ContextAwareDenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    /**
     *
     */
    private const ALREADY_CALLED_DENORMALIZER = 'OwnedDenormalizer';

    /**
     * @var Security
     */
    private Security $security;

    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    /**
     * OwnedDenormalizer constructor.
     * @param Security $security
     * @param UserRepository $repository
     */
    public function __construct(Security $security, UserRepository $repository)
    {
        $this->security = $security;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
    {
        $hasBeenCalled = $context[self::ALREADY_CALLED_DENORMALIZER] ?? false;
        $isResourceOwned = $type === Book::class || $type === Author::class;

        return $isResourceOwned && $hasBeenCalled === false;
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $context[self::ALREADY_CALLED_DENORMALIZER] = true;

        $resource = $this->denormalizer->denormalize($data, $type, $format, $context);

        $operation = $context['collection_operation_name'] ?? $context['item_operation_name'];

        if ($operation === 'post') {
            /** @var User $currentUser */
            $currentUser = $this->security->getUser();
            $owner = $this->repository->findOneById($currentUser->getId());
            $resource->setOwner($owner);
        }

        return $resource;
    }
}