<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\PublisherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Collection as PublisherCollection;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"publisher:read"}},
 *     denormalizationContext={"groups"={"publisher:write"}}
 * )
 * @ORM\Entity(repositoryClass=PublisherRepository::class)
 */
class Publisher
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"publisher:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"publisher:read", "publisher:write"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="publisher", orphanRemoval=true)
     * @Groups({"publisher:read"})
     * @ApiSubresource
     */
    private $books;

    /**
     * @ORM\OneToMany(targetEntity=PublisherCollection::class, mappedBy="publisher", orphanRemoval=true)
     * @Groups({"publisher:read"})
     * @ApiSubresource
     */
    private $collections;

    /**
     * Publisher constructor.
     */
    public function __construct()
    {
        $this->books = new ArrayCollection();
        $this->collections = new ArrayCollection();
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    /**
     * @param Book $book
     * @return $this
     */
    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setPublisher($this);
        }

        return $this;
    }

    /**
     * @param Book $book
     * @return $this
     */
    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getPublisher() === $this) {
                $book->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PublisherCollection[]
     */
    public function getCollections(): Collection
    {
        return $this->collections;
    }

    /**
     * @param \App\Entity\Collection $collection
     * @return $this
     */
    public function addCollection(PublisherCollection $collection): self
    {
        if (!$this->collections->contains($collection)) {
            $this->collections[] = $collection;
            $collection->setPublisher($this);
        }

        return $this;
    }

    /**
     * @param \App\Entity\Collection $collection
     * @return $this
     */
    public function removeCollection(PublisherCollection $collection): self
    {
        if ($this->collections->removeElement($collection)) {
            // set the owning side to null (unless already changed)
            if ($collection->getPublisher() === $this) {
                $collection->setPublisher(null);
            }
        }

        return $this;
    }
}
