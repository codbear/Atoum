<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"book:read"}},
 *     denormalizationContext={"groups"={"book:write"}},
 *     collectionOperations={
 *         "get",
 *         "post"
 *     },
 *     itemOperations={
 *         "get",
 *         "patch",
 *         "delete"
 *     }
 * )
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("book:read")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 2,
     *     max = 255,
     * )
     * @Groups({"book:read", "book:write"})
     */
    private ?string $title;

    /**
     * @ORM\Column(type="string", length=13, nullable=true)
     * @Assert\Isbn()
     * @Groups({"book:read", "book:write"})
     */
    private ?string $isbn;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"book:read", "book:write"})
     */
    private ?string $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *     min = 1,
     *     max = 1000,
     * )
     * @Groups({"book:read", "book:write"})
     */
    private ?int $volume;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     * @Groups({"book:read", "book:write"})
     */
    private ?bool $hasBeenRead = false;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     * @Groups({"book:read", "book:write"})
     */
    private ?bool $isEbook = false;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"book:read", "book:write"})
     */
    private ?string $observations;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *     min = 0,
     *     max = 2100,
     * )
     * @Groups({"book:read", "book:write"})
     */
    private ?int $publicationYear;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull()
     * @Groups("book:read")
     */
    private ?\DateTimeInterface $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(?int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getHasBeenRead(): ?bool
    {
        return $this->hasBeenRead;
    }

    public function setHasBeenRead(bool $hasBeenRead): self
    {
        $this->hasBeenRead = $hasBeenRead;

        return $this;
    }

    public function getIsEbook(): ?bool
    {
        return $this->isEbook;
    }

    public function setIsEbook(bool $isEbook): self
    {
        $this->isEbook = $isEbook;

        return $this;
    }

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): self
    {
        $this->observations = $observations;

        return $this;
    }

    public function getPublicationYear(): ?int
    {
        return $this->publicationYear;
    }

    public function setPublicationYear(?int $publicationYear): self
    {
        $this->publicationYear = $publicationYear;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
