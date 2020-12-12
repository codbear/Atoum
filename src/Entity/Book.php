<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BookRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"book:read"}},
 *     denormalizationContext={"groups"={"book:write"}},
 *     collectionOperations={
 *         "get"={"security"="is_granted('ROLE_USER')"},
 *         "post"={"security"="is_granted('ROLE_USER')"}
 *     },
 *     itemOperations={
 *         "get"={"security"="is_granted('get', object)"},
 *         "patch"={"security"="is_granted('edit', object)"},
 *         "put"={"security"="is_granted('edit', object)"},
 *         "delete"={"security"="is_granted('delete', object)"}
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

    /**
     * @ORM\ManyToOne(targetEntity=Publisher::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"book:read", "book:write"})
     */
    private $publisher;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="books")
     * @Groups({"book:read", "book:write"})
     */
    private $genres;

    /**
     * @ORM\ManyToOne(targetEntity=BindingFormat::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"book:read", "book:write"})
     */
    private $bindingFormat;

    /**
     * @ORM\ManyToMany(targetEntity=Author::class, inversedBy="books")
     * @Groups({"book:read", "book:write"})
     */
    private $authors;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"book:read"})
     */
    private $owner;

    /**
     * Book constructor.
     */
    public function __construct()
    {
        $this->genres = new ArrayCollection();
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
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Publisher|null
     */
    public function getPublisher(): ?Publisher
    {
        return $this->publisher;
    }

    /**
     * @param Publisher|null $publisher
     * @return $this
     */
    public function setPublisher(?Publisher $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    /**
     * @param Genre $genre
     * @return $this
     */
    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    /**
     * @param Genre $genre
     * @return $this
     */
    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * @return BindingFormat|null
     */
    public function getBindingFormat(): ?BindingFormat
    {
        return $this->bindingFormat;
    }

    /**
     * @param BindingFormat|null $bindingFormat
     * @return $this
     */
    public function setBindingFormat(?BindingFormat $bindingFormat): self
    {
        $this->bindingFormat = $bindingFormat;

        return $this;
    }

    /**
     * @return Collection|Author[]
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    /**
     * @param Author $author
     * @return $this
     */
    public function addAuthor(Author $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors[] = $author;
        }

        return $this;
    }

    /**
     * @param Author $author
     * @return $this
     */
    public function removeAuthor(Author $author): self
    {
        $this->authors->removeElement($author);

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
}
