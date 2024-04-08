<?php

namespace App\Entity;

use App\Entity\Couleur;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomProduit = null;

    // #[ORM\Column(type: types::TEXT, nullable: true)]
    // private ?string $DescriptionProduit = null;

    #[ORM\Column]
    private ?float $PrixProduit = null;

    #[ORM\Column]
    private ?int $StockDispo = null;

    #[ORM\Column]
    private ?float $Taille = null;

    #[ORM\OneToMany(mappedBy: 'Produit', targetEntity: Couleur::class)]
    private Collection $couleurs;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ImagePath = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'ImagePath')]
    private ?File $imageFile = null;

    #[ORM\Column(type: types::TEXT, nullable: true)]
    private ?string $DescriptionProduit = null;

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
    
    // public function getDescriptionProduit(): ?string
    // {
    //     return $this->DescriptionProduit;
    // }

    // public function setDescriptionroduit(string $DescriptionProduit): static
    // {
    //     $this->DescriptionProduit = $DescriptionProduit;

    //     return $this;
    // }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        // if (null !== $imageFile) {
        //     // It is required that at least one field changes if you are using doctrine
        //     // otherwise the event listeners won't be called and the file is lost
        //     $this->updatedAt = new \DateTimeImmutable();
        // }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getStockDispo(): ?int
    {
        return $this->StockDispo;
    }

    public function setStockDispo(?int $StockDispo): static
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

    public function getPrixProduit(): ?float
    {
        return $this->PrixProduit;
    }

    public function setPrixProduit(float $PrixProduit): static
    {
        $this->PrixProduit = $PrixProduit;

        return $this;
    }

    public function getDescriptionProduit(): ?string
    {
        return $this->DescriptionProduit;
    }

    public function setDescriptionProduit(string $DescriptionProduit): static
    {
        $this->DescriptionProduit = $DescriptionProduit;

        return $this;
    }
}
