<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column]
    private ?int $idUser = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $address = null;

    #[ORM\ManyToMany(targetEntity: Book::class, inversedBy: 'orders')]
    private Collection $produse;

    public function __construct()
    {
        $this->produse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getProduse(): Collection
    {
        return $this->produse;
    }

    public function addProduse(Book $produse): static
    {
        if (!$this->produse->contains($produse)) {
            $this->produse->add($produse);
        }

        return $this;
    }

    public function removeProduse(Book $produse): static
    {
        $this->produse->removeElement($produse);

        return $this;
    }
}
