<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomUser = null;

    #[ORM\Column(length: 255)]
    private ?string $PrenomUser = null;

    #[ORM\Column(length: 255)]
    private ?string $EmailUser = null;

    #[ORM\Column(length: 255)]
    private ?string $MotDePasseUser = null;

    #[ORM\Column]
    private ?int $NumDeTelUser = null;


    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Commande::class)]
    private Collection $Commande;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?AdresseFacturation $AdresseFacturation = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: AdresseLivraison::class)]
    private Collection $AdresseLivraison;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Avis::class)]
    private Collection $Avis;

    public function __construct()
    {
      
        $this->Commande = new ArrayCollection();
        $this->AdresseLivraison = new ArrayCollection();
        $this->Avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUser(): ?string
    {
        return $this->NomUser;
    }

    public function setNomUser(string $NomUser): static
    {
        $this->NomUser = $NomUser;

        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->PrenomUser;
    }

    public function setPrenomUser(string $PrenomUser): static
    {
        $this->PrenomUser = $PrenomUser;

        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->EmailUser;
    }

    public function setEmailUser(string $EmailUser): static
    {
        $this->EmailUser = $EmailUser;

        return $this;
    }

    public function getMotDePasseUser(): ?string
    {
        return $this->MotDePasseUser;
    }

    public function setMotDePasseUser(string $MotDePasseUser): static
    {
        $this->MotDePasseUser = $MotDePasseUser;

        return $this;
    }

    public function getNumDeTelUser(): ?int
    {
        return $this->NumDeTelUser;
    }

    public function setNumDeTelUser(int $NumDeTelUser): static
    {
        $this->NumDeTelUser = $NumDeTelUser;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    

    /**
     * @return Collection<int, Commande>
     */
    public function getCommande(): Collection
    {
        return $this->Commande;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->Commande->contains($commande)) {
            $this->Commande->add($commande);
            $commande->setUser($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->Commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getUser() === $this) {
                $commande->setUser(null);
            }
        }

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

    /**
     * @return Collection<int, AdresseLivraison>
     */
    public function getAdresseLivraison(): Collection
    {
        return $this->AdresseLivraison;
    }

    public function addAdresseLivraison(AdresseLivraison $adresseLivraison): static
    {
        if (!$this->AdresseLivraison->contains($adresseLivraison)) {
            $this->AdresseLivraison->add($adresseLivraison);
            $adresseLivraison->setUser($this);
        }

        return $this;
    }

    public function removeAdresseLivraison(AdresseLivraison $adresseLivraison): static
    {
        if ($this->AdresseLivraison->removeElement($adresseLivraison)) {
            // set the owning side to null (unless already changed)
            if ($adresseLivraison->getUser() === $this) {
                $adresseLivraison->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->Avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->Avis->contains($avi)) {
            $this->Avis->add($avi);
            $avi->setUser($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->Avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getUser() === $this) {
                $avi->setUser(null);
            }
        }

        return $this;
    }
}
