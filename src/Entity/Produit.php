<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomProduit = null;

    #[ORM\Column(length: 255)]
    private ?string $PrenomProduit = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $PrixProduit = null;

    #[ORM\Column]
    private ?float $StockDispo = null;

    #[ORM\Column]
    private ?float $Taille = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Stock $Stock = null;

    #[ORM\OneToMany(mappedBy: 'Produit', targetEntity: Couleur::class)]
    private Collection $couleurs;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ImagePath = null;


    public function __construct()
    {
        $this->couleurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->NomProduit;
    }

    public function setNomProduit(string $NomProduit): static
    {
        $this->NomProduit = $NomProduit;

        return $this;
    }

    public function getPrenomProduit(): ?string
    {
        return $this->PrenomProduit;
    }

    public function setPrenomProduit(string $PrenomProduit): static
    {
        $this->PrenomProduit = $PrenomProduit;

        return $this;
    }

    public function getPrixProduit(): ?string
    {
        return $this->PrixProduit;
    }

    public function setPrixProduit(string $PrixProduit): static
    {
        $this->PrixProduit = $PrixProduit;

        return $this;
    }

    public function getStockDispo(): ?float
    {
        return $this->StockDispo;
    }

    public function setStockDispo(float $StockDispo): static
    {
        $this->StockDispo = $StockDispo;

        return $this;
    }

    public function getTaille(): ?float
    {
        return $this->Taille;
    }

    public function setTaille(float $Taille): static
    {
        $this->Taille = $Taille;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->Stock;
    }

    public function setStock(?Stock $Stock): static
    {
        $this->Stock = $Stock;

        return $this;
    }

    /**
     * @return Collection<int, Couleur>
     */
    public function getCouleurs(): Collection
    {
        return $this->couleurs;
    }

    public function addCouleur(Couleur $couleur): static
    {
        if (!$this->couleurs->contains($couleur)) {
            $this->couleurs->add($couleur);
            $couleur->setProduit($this);
        }

        return $this;
    }

    public function removeCouleur(Couleur $couleur): static
    {
        if ($this->couleurs->removeElement($couleur)) {
            // set the owning side to null (unless already changed)
            if ($couleur->getProduit() === $this) {
                $couleur->setProduit(null);
            }
        }

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->ImagePath;
    }

    public function setImagePath(?string $ImagePath): static
    {
        $this->ImagePath = $ImagePath;

        return $this;
    }
}
