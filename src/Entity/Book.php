<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: BookImages::class, orphanRemoval: true)]
    private Collection $bookImages;

    #[ORM\Column(length: 255)]
    private ?string $editura = null;

    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'books')]
    private Collection $authors;

    #[ORM\ManyToMany(targetEntity: Orders::class, mappedBy: 'produse')]
    private Collection $orders;

    public function __construct()
    {
        $this->bookImages = new ArrayCollection();
        $this->authors = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, BookImages>
     */
    public function getBookImages(): Collection
    {
        return $this->bookImages;
    }

    public function addBookImage(BookImages $bookImage): static
    {
        if (!$this->bookImages->contains($bookImage)) {
            $this->bookImages->add($bookImage);
            $bookImage->setBook($this);
        }

        return $this;
    }

    public function removeBookImage(BookImages $bookImage): static
    {
        if ($this->bookImages->removeElement($bookImage)) {
            // set the owning side to null (unless already changed)
            if ($bookImage->getBook() === $this) {
                $bookImage->setBook(null);
            }
        }

        return $this;
    }

    public function getEditura(): ?string
    {
        return $this->editura;
    }

    public function setEditura(string $editura): static
    {
        $this->editura = $editura;

        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
        }

        return $this;
    }

    public function removeAuthor(Author $author): static
    {
        $this->authors->removeElement($author);

        return $this;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->addProduse($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): static
    {
        if ($this->orders->removeElement($order)) {
            $order->removeProduse($this);
        }

        return $this;
    }
}
