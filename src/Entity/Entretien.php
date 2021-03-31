<?php

namespace App\Entity;

use App\Repository\EntretienRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntretienRepository::class)
 */
class Entretien
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Date_Entretien;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Type_Entretien;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Offre::class, inversedBy="Entretien")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Offre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntretien(): ?\DateTimeInterface
    {
        return $this->Date_Entretien;
    }

    public function setDateEntretien(?\DateTimeInterface $Date_Entretien): self
    {
        $this->Date_Entretien = $Date_Entretien;

        return $this;
    }

    public function getTypeEntretien(): ?string
    {
        return $this->Type_Entretien;
    }

    public function setTypeEntretien(?string $Type_Entretien): self
    {
        $this->Type_Entretien = $Type_Entretien;

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

    public function getOffre(): ?Offre
    {
        return $this->Offre;
    }

    public function setOffre(?Offre $Offre): self
    {
        $this->Offre = $Offre;

        return $this;
    }
}
