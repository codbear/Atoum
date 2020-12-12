<?php


namespace App\DataPersister;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class UserDataPersister
 * @package App\DataPersister
 */
class UserDataPersister extends DataPersister
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $_passwordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager,
        RequestStack $request,
        Security $security,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        parent::__construct($entityManager, $request, $security);
        $this->_passwordEncoder = $passwordEncoder;
    }

    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    /**
     * @inheritDoc
     */
    public function persist($data, array $context = [])
    {
        $data->setPassword(
            $this->_passwordEncoder->encodePassword(
                $data,
                $data->getPassword()
            )
        );

        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}