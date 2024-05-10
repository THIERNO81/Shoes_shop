<?php

namespace App\Entity;

use App\Repository\TvaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TvaRepository::class)]
class Taxe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    #[ORM\Column]
    private ?int $Taux = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): static
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getTaux(): ?int
    {
        return $this->Taux;
    }

    public function setTaux(int $Taux): static
    {
        $this->Taux = $Taux;

        return $this;
    }
}
