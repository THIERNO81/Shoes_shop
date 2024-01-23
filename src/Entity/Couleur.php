<?php

namespace App\Entity;

use App\Repository\CouleurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouleurRepository::class)]
class Couleur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ProduitId = null;

    #[ORM\Column(length: 255)]
    private ?string $Noir = null;

    #[ORM\Column(length: 255)]
    private ?string $Blanc = null;

    #[ORM\Column(length: 255)]
    private ?string $Bleu = null;

    #[ORM\Column(length: 255)]
    private ?string $Orange = null;

    #[ORM\Column(length: 255)]
    private ?string $Violet = null;

    #[ORM\Column(length: 255)]
    private ?string $Vert = null;

    #[ORM\Column(length: 255)]
    private ?string $Gris = null;

    #[ORM\ManyToOne(inversedBy: 'couleurs')]
    private ?Produit $Produit = null;

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

    public function getNoir(): ?string
    {
        return $this->Noir;
    }

    public function setNoir(string $Noir): static
    {
        $this->Noir = $Noir;

        return $this;
    }

    public function getBlanc(): ?string
    {
        return $this->Blanc;
    }

    public function setBlanc(string $Blanc): static
    {
        $this->Blanc = $Blanc;

        return $this;
    }

    public function getBleu(): ?string
    {
        return $this->Bleu;
    }

    public function setBleu(string $Bleu): static
    {
        $this->Bleu = $Bleu;

        return $this;
    }

    public function getOrange(): ?string
    {
        return $this->Orange;
    }

    public function setOrange(string $Orange): static
    {
        $this->Orange = $Orange;

        return $this;
    }

    public function getViolet(): ?string
    {
        return $this->Violet;
    }

    public function setViolet(string $Violet): static
    {
        $this->Violet = $Violet;

        return $this;
    }

    public function getVert(): ?string
    {
        return $this->Vert;
    }

    public function setVert(string $Vert): static
    {
        $this->Vert = $Vert;

        return $this;
    }

    public function getGris(): ?string
    {
        return $this->Gris;
    }

    public function setGris(string $Gris): static
    {
        $this->Gris = $Gris;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->Produit;
    }

    public function setProduit(?Produit $Produit): static
    {
        $this->Produit = $Produit;

        return $this;
    }
}
