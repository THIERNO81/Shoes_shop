<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $UserId = null;

    #[ORM\Column(length: 255)]
    private ?string $PaiementStripe = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateCommande = null;

    #[ORM\Column(length: 255)]
    private ?string $StatutCommande = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $MontantTtc = null;

    #[ORM\ManyToOne(inversedBy: 'Commande')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?AdresseLivraison $Commande = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?DetailsCommande $DetailsCommande = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?AdresseFacturation $AdresseFacturation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->UserId;
    }

    public function setUserId(int $UserId): static
    {
        $this->UserId = $UserId;

        return $this;
    }

    public function getPaiementStripe(): ?string
    {
        return $this->PaiementStripe;
    }

    public function setPaiementStripe(string $PaiementStripe): static
    {
        $this->PaiementStripe = $PaiementStripe;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->DateCommande;
    }

    public function setDateCommande(\DateTimeInterface $DateCommande): static
    {
        $this->DateCommande = $DateCommande;

        return $this;
    }

    public function getStatutCommande(): ?string
    {
        return $this->StatutCommande;
    }

    public function setStatutCommande(string $StatutCommande): static
    {
        $this->StatutCommande = $StatutCommande;

        return $this;
    }

    public function getMontantTtc(): ?string
    {
        return $this->MontantTtc;
    }

    public function setMontantTtc(string $MontantTtc): static
    {
        $this->MontantTtc = $MontantTtc;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCommande(): ?AdresseLivraison
    {
        return $this->Commande;
    }

    public function setCommande(?AdresseLivraison $Commande): static
    {
        $this->Commande = $Commande;

        return $this;
    }

    public function getDetailsCommande(): ?DetailsCommande
    {
        return $this->DetailsCommande;
    }

    public function setDetailsCommande(?DetailsCommande $DetailsCommande): static
    {
        $this->DetailsCommande = $DetailsCommande;

        return $this;
    }

    public function getAdresseFacturation(): ?AdresseFacturation
    {
        return $this->AdresseFacturation;
    }

    public function setAdresseFacturation(?AdresseFacturation $AdresseFacturation): static
    {
        $this->AdresseFacturation = $AdresseFacturation;

        return $this;
    }

}
