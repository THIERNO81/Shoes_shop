<?php

namespace App\Entity;

use App\Repository\AdresseLivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Entreprise;

#[ORM\Entity(repositoryClass: AdresseLivraisonRepository::class)]
class AdresseLivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id")]
    private ?int $id;

    #[ORM\Column(name:"user_id")]
    private ?int $UserId;

    #[ORM\Column(name:"lib_rue_adresse_livraison")]
    private ?string $LibRueAdresseLivraison = null;

    #[ORM\Column(name:"cp_adresse_livraison")]
    private ?int $CpAdresseLivraison = null;

    #[ORM\Column(name:"ville_adresse_livraison")]
    private ?string $VilleAdresseLivraison = null;

    #[ORM\Column(name:"commentaire_adresse_livr")]
    private ?string $CommentaireAdresseLivr = null;

    #[ORM\ManyToOne(inversedBy: 'AdresseLivraison')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'Commande', targetEntity: Commande::class)]
    private Collection $commandes;


    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;


    

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

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

    public function getLibRueAdresseLivraison(): ?string
    {
        return $this->LibRueAdresseLivraison;
    }

    public function setLibRueAdresseLivraison(string $LibRueAdresseLivraison): static
    {
        $this->LibRueAdresseLivraison = $LibRueAdresseLivraison;

        return $this;
    }

    public function getCpAdresseLivraison(): ?int
    {
        return $this->CpAdresseLivraison;
    }

    public function setCpAdresseLivraison(int $CpAdresseLivraison): static
    {
        $this->CpAdresseLivraison = $CpAdresseLivraison;

        return $this;
    }

    public function getVilleAdresseLivraison(): ?string
    {
        return $this->VilleAdresseLivraison;
    }

    public function setVilleAdresseLivraison(string $VilleAdresseLivraison): static
    {
        $this->VilleAdresseLivraison = $VilleAdresseLivraison;

        return $this;
    }

    public function getCommentaireAdresseLivr(): ?string
    {
        return $this->CommentaireAdresseLivr;
    }

    public function setCommentaireAdresseLivr(string $CommentaireAdresseLivr): static
    {
        $this->CommentaireAdresseLivr = $CommentaireAdresseLivr;

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

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setCommande($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getCommande() === $this) {
                $commande->setCommande(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    { 
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    private $fullname;
    private $entreprise;

    public function __toString()
    {
        $result = $this->fullname;

        if ($this->getEntreprise()) {
            $result .= "Entreprise:" . $this->entreprise;
        }


    $result .= $this->LibRueAdresseLivraison;
    $result .= $this->CpAdresseLivraison;
    $result .= $this->VilleAdresseLivraison;

    // Utilisez $this->CommentaireAdresseLivr s'il s'agit de l'attribut correct
    $result .= $this->CommentaireAdresseLivr ;

    return $result;
    }
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    }



