<?php

namespace App\Entity;

use App\Repository\DetailsCommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailsCommandeRepository::class)]
class DetailsCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    

    #[ORM\Column(length: 255)]
    private ?string $DetailsCommande = null;

    #[ORM\Column]
    private ?int $QteDetailsCommande = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $PrixTtc = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Stock $Stock = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Commande $Commande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getDetailsCommande(): ?string
    {
        return $this->DetailsCommande;
    }

    public function setDetailsCommande(string $DetailsCommande): static
    {
        $this->DetailsCommande = $DetailsCommande;

        return $this;
    }

    public function getQteDetailsCommande(): ?int
    {
        return $this->QteDetailsCommande;
    }

    public function setQteDetailsCommande(int $QteDetailsCommande): static
    {
        $this->QteDetailsCommande = $QteDetailsCommande;

        return $this;
    }

    public function getPrixTtc(): ?string
    {
        return $this->PrixTtc;
    }

    public function setPrixTtc(string $PrixTtc): static
    {
        $this->PrixTtc = $PrixTtc;

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

    public function getCommande(): ?Commande
    {
        return $this->Commande;
    }

    public function setCommande(?Commande $Commande): static
    {
        $this->Commande = $Commande;

        return $this;
    }
}
