<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Entreprise;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Postes_Vacants;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Type_Contrat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Experience;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Remuneration;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Langues;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Date_Expiration;

    /**
     * @ORM\OneToMany(targetEntity=Entretien::class, mappedBy="Offre", orphanRemoval=true)
     */
    private $Entretien;

    public function __construct()
    {
        $this->Entretien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(?string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->Entreprise;
    }

    public function setEntreprise(?string $Entreprise): self
    {
        $this->Entreprise = $Entreprise;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getPostesVacants(): ?string
    {
        return $this->Postes_Vacants;
    }

    public function setPostesVacants(?string $Postes_Vacants): self
    {
        $this->Postes_Vacants = $Postes_Vacants;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->Type_Contrat;
    }

    public function setTypeContrat(?string $Type_Contrat): self
    {
        $this->Type_Contrat = $Type_Contrat;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->Experience;
    }

    public function setExperience(?string $Experience): self
    {
        $this->Experience = $Experience;

        return $this;
    }

    public function getRemuneration(): ?string
    {
        return $this->Remuneration;
    }

    public function setRemuneration(?string $Remuneration): self
    {
        $this->Remuneration = $Remuneration;

        return $this;
    }

    public function getLangues(): ?string
    {
        return $this->Langues;
    }

    public function setLangues(?string $Langues): self
    {
        $this->Langues = $Langues;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->Date_Expiration;
    }

    public function setDateExpiration(?\DateTimeInterface $Date_Expiration): self
    {
        $this->Date_Expiration = $Date_Expiration;

        return $this;
    }

    /**
     * @return Collection|Entretien[]
     */
    public function getEntretien(): Collection
    {
        return $this->Entretien;
    }

    public function addEntretien(Entretien $entretien): self
    {
        if (!$this->Entretien->contains($entretien)) {
            $this->Entretien[] = $entretien;
            $entretien->setOffre($this);
        }

        return $this;
    }

    public function removeEntretien(Entretien $entretien): self
    {
        if ($this->Entretien->removeElement($entretien)) {
            // set the owning side to null (unless already changed)
            if ($entretien->getOffre() === $this) {
                $entretien->setOffre(null);
            }
        }

        return $this;
    }
}
