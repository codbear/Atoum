<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"book:read", "book:write"})
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity=Author::class, inversedBy="books")
     * @Groups({"book:read", "book:write"})
     */
    private $authors;

    /**
     * Book constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->authors = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    /**
     * @param string|null $isbn
     * @return $this
     */
    public function setIsbn(?string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVolume(): ?int
    {
        return $this->volume;
    }

    /**
     * @param int|null $volume
     * @return $this
     */
    public function setVolume(?int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getHasBeenRead(): ?bool
    {
        return $this->hasBeenRead;
    }

    /**
     * @param bool $hasBeenRead
     * @return $this
     */
    public function setHasBeenRead(bool $hasBeenRead): self
    {
        $this->hasBeenRead = $hasBeenRead;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsEbook(): ?bool
    {
        return $this->isEbook;
    }

    /**
     * @param bool $isEbook
     * @return $this
     */
    public function setIsEbook(bool $isEbook): self
    {
        $this->isEbook = $isEbook;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObservations(): ?string
    {
        return $this->observations;
    }

    /**
     * @param string|null $observations
     * @return $this
     */
    public function setObservations(?string $observations): self
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPublicationYear(): ?int
    {
        return $this->publicationYear;
    }

    /**
     * @param int|null $publicationYear
     * @return $this
     */
    public function setPublicationYear(?int $publicationYear): self
    {
        $this->publicationYear = $publicationYear;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getOwner(): ?User
    {
        return $this->owner;
    }

    /**
     * @param User|null $owner
     * @return $this
     */
    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors->getValues();
    }

    public function addAuthor(Author $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors[] = $author;
        }

        return $this;
    }

    public function removeAuthor(Author $author): self
    {
        $this->authors->removeElement($author);

        return $this;
    }
}
