<?php

namespace App\Entity;

use App\Repository\AdresseFacturationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseFacturationRepository::class)]
class AdresseFacturation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $UserId = null;

    #[ORM\Column(length: 255)]
    private ?string $LibAdressFacturation = null;

    #[ORM\Column]
    private ?int $CpAdresseFacturation = null;

    #[ORM\Column(length: 255)]
    private ?string $VilleAdresseFacturation = null;

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

    public function getLibAdressFacturation(): ?string
    {
        return $this->LibAdressFacturation;
    }

    public function setLibAdressFacturation(string $LibAdressFacturation): static
    {
        $this->LibAdressFacturation = $LibAdressFacturation;

        return $this;
    }

    public function getCpAdresseFacturation(): ?int
    {
        return $this->CpAdresseFacturation;
    }

    public function setCpAdresseFacturation(int $CpAdresseFacturation): static
    {
        $this->CpAdresseFacturation = $CpAdresseFacturation;

        return $this;
    }

    public function getVilleAdresseFacturation(): ?string
    {
        return $this->VilleAdresseFacturation;
    }

    public function setVilleAdresseFacturation(string $VilleAdresseFacturation): static
    {
        $this->VilleAdresseFacturation = $VilleAdresseFacturation;

        return $this;
    }
}
