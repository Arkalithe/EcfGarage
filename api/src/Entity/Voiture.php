<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VoitureRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Caracteristique;
use App\Entity\Equipement;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
#[ApiResource]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $path = null;

    #[ORM\ManyToMany(targetEntity: Caracteristique::class)]
    #[ORM\JoinTable(name: 'voiture_caracteristique')]
    #[ORM\JoinColumn(name: 'voiture_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'caracteristique_id', referencedColumnName: 'id')]
    private $caracteristiques;

    #[ORM\ManyToMany(targetEntity: Equipement::class)]
    #[ORM\JoinTable(name: 'voiture_equipement')]
    #[ORM\JoinColumn(name: 'voiture_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'equipement_id', referencedColumnName: 'id')]
    private $equipements;

    public function __construct()
    {
        $this->caracteristiques = new ArrayCollection();
        $this->equipements = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getCaracteristique(): Collection
    {
        return $this->caracteristiques;
    }

    public function setCaracteristique(Collection $caracteristique): static
    {
        $this->caracteristiques = $caracteristique;

        return $this;
    }

    public function getEquipement(): Collection
    {
        return $this->equipements;
    }

    public function setEquipement(Collection $equipement): static
    {
        $this->equipements = $equipement;

        return $this;
    }
}
