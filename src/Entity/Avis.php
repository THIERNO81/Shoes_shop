<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $UserId = null;

    #[ORM\Column(length: 255)]
    private ?string $NoteAvis = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateAvis = null;

    #[ORM\ManyToOne(inversedBy: 'Avis')]
    private ?User $user = null;

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

    public function getNoteAvis(): ?string
    {
        return $this->NoteAvis;
    }

    public function setNoteAvis(string $NoteAvis): static
    {
        $this->NoteAvis = $NoteAvis;

        return $this;
    }

    public function getDateAvis(): ?\DateTimeInterface
    {
        return $this->DateAvis;
    }

    public function setDateAvis(\DateTimeInterface $DateAvis): static
    {
        $this->DateAvis = $DateAvis;

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
}
