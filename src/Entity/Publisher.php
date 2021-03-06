<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PublisherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"publisher:read"}},
 *     denormalizationContext={"groups"={"publisher:write"}},
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
 * @ORM\Entity(repositoryClass=PublisherRepository::class)
 */
class Publisher
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"publisher:read", "book:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"publisher:read", "publisher:write", "book:read"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="publishers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"publisher:read", "book:read"})
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="publisher", orphanRemoval=true)
     * @Groups("publisher:read")
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setPublisher($this);
        }

        return $this;
    }

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
}
