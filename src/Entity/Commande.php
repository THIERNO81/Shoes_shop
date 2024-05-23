<?php

namespace App\Entity;


use Doctrine\DBAL\Types\Types;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


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
    private ?string $PaiementStripe = ''; 

    #[ORM\Column(length: 255)]
    private string $StatutCommande = ''; // Modification ici

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, options: ["default" => 0])] // Modification ici
    private string $MontantTtc = '0'; // Modification ici

    #[ORM\ManyToOne(inversedBy:  'Commande')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?AdresseLivraison $Commande = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?DetailsCommande $DetailsCommande = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?AdresseFacturation $AdresseFacturation = null;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AdresseLivraison")
     * @ORM\JoinColumn(nullable=false)
     */
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Transporteurs")
     * @ORM\JoinColumn(nullable=false)
     */

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

    
    
    public function getStatutCommande(): string
    {
        return $this->StatutCommande;
    }

    public function setStatutCommande(string $StatutCommande): static
    {
        $this->StatutCommande = $StatutCommande;

        return $this;
    }

    public function getMontantTtc(): string // Modification ici
    {
        return $this->MontantTtc;
    }

    public function setMontantTtc(string $MontantTtc): static // Modification ici
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

    private $detailsCommandes;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateCommande = null;

  

    public function __construct()
    {
        $this->detailsCommandes = new ArrayCollection();
    }

    // Autres propriétés et méthodes de l'entité Commande

    /**
     * @return Collection|DetailsCommande[]
     */
    public function getDetailsCommandes(): Collection
    {
        return $this->detailsCommandes;
    }

    public function addDetailsCommande(DetailsCommande $detailsCommande): self
    {
        if (!$this->detailsCommandes->contains($detailsCommande)) {
            $this->detailsCommandes[] = $detailsCommande;
            $detailsCommande->setCommande($this);
        }

        return $this;
    }

    public function removeDetailsCommande(DetailsCommande $detailsCommande): self
    {
        if ($this->detailsCommandes->removeElement($detailsCommande)) {
            // set the owning side to null (unless already changed)
            if ($detailsCommande->getCommande() === $this) {
                $detailsCommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->DateCommande;
    }

    public function setDateCommande(?\DateTimeInterface $DateCommande): static
    {
        $this->DateCommande = $DateCommande;

        return $this;
    }

    private $adresseLivraison;

   

    public function getAdresseLivraison(): ?AdresseLivraison
    {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison(?AdresseLivraison $adresseLivraison): self
    {
        $this->adresseLivraison = $adresseLivraison;
        return $this;
    }

    private $transporteur;

 

    public function getTransporteur(): ?Transporteurs
    {
        return $this->transporteur;
    }

    public function setTransporteur(?Transporteurs $transporteur): self
    {
        $this->transporteur = $transporteur;
        return $this;
    }

}
    




