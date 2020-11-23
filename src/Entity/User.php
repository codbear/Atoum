<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}}
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user:read", "user:write"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"user:read"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"user:write"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"user:read", "user:write"})
     */
    private $username;

    /**
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="owner", orphanRemoval=true)
     * @Groups({"user:read"})
     */
    private $books;

    /**
     * @ORM\OneToMany(targetEntity=Author::class, mappedBy="owner", orphanRemoval=true)
     * @Groups({"user:read"})
     */
    private $authors;

    /**
     * @ORM\OneToMany(targetEntity=Genre::class, mappedBy="owner", orphanRemoval=true)
     * @Groups({"user:read"})
     */
    private $genres;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->books = new ArrayCollection();
        $this->authors = new ArrayCollection();
        $this->genres = new ArrayCollection();
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
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @param string $roles
     * @return bool
     */
    public function hasRoles(string $roles): bool
    {
        return in_array($roles, $this->roles);
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

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
            $book->setOwner($this);
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
            if ($book->getOwner() === $this) {
                $book->setOwner(null);
            }
        }

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
            $author->setOwner($this);
        }

        return $this;
    }

    /**
     * @param Author $author
     * @return $this
     */
    public function removeAuthor(Author $author): self
    {
        if ($this->authors->removeElement($author)) {
            // set the owning side to null (unless already changed)
            if ($author->getOwner() === $this) {
                $author->setOwner(null);
            }
        }

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
            $genre->setOwner($this);
        }

        return $this;
    }

    /**
     * @param Genre $genre
     * @return $this
     */
    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->removeElement($genre)) {
            // set the owning side to null (unless already changed)
            if ($genre->getOwner() === $this) {
                $genre->setOwner(null);
            }
        }

        return $this;
    }
}
