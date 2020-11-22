<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BookRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"book:read"}},
 *     denormalizationContext={"groups"={"book:write"}}
 * )
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"book:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"book:read", "book:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=13, nullable=true)
     * @Groups({"book:read", "book:write"})
     */
    private $isbn;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"book:read", "book:write"})
     */
    private $volume;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"book:read", "book:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"book:read", "book:write"})
     */
    private $observations;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"book:read", "book:write"})
     */
    private $hasBeenRead;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"book:read", "book:write"})
     */
    private $isEbook;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"book:read", "book:write"})
     */
    private $publicationYear;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"book:read"})
     */
    private $createdAt;

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

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(?int $volume): self
    {
        $this->volume = $volume;

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

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): self
    {
        $this->observations = $observations;

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

    public function getPublicationYear(): ?int
    {
        return $this->publicationYear;
    }

    public function setPublicationYear(?int $publicationYear): self
    {
        $this->publicationYear = $publicationYear;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
