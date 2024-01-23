<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ProduitId = null;

    #[ORM\Column]
    private ?int $QuantitéStock = null;

    #[ORM\OneToMany(mappedBy: 'Stock', targetEntity: Produit::class)]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduitId(): ?int
    {
        return $this->ProduitId;
    }

    public function setProduitId(int $ProduitId): static
    {
        $this->ProduitId = $ProduitId;

        return $this;
    }

    public function getQuantitéStock(): ?int
    {
        return $this->QuantitéStock;
    }

    public function setQuantitéStock(int $QuantitéStock): static
    {
        $this->QuantitéStock = $QuantitéStock;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setStock($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getStock() === $this) {
                $produit->setStock(null);
            }
        }

        return $this;
    }
}
