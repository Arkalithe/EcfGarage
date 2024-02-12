<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\HoraireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoraireRepository::class)]
#[ApiResource]
class Horaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $jour_semaine = null;

    #[ORM\Column(type: "time")]
    private ?\DateTimeInterface $ouverture_matin = null;

    #[ORM\Column(type: "time")]
    private ?\DateTimeInterface $fermeture_matin = null;

    #[ORM\Column(type: "time")]
    private ?\DateTimeInterface $ouverture_apres_midi = null;

    #[ORM\Column(type: "time")]
    private ?\DateTimeInterface $fermeture_apres_midi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJourSemaine(): ?string
    {
        return $this->jour_semaine;
    }

    public function setJourSemaine(string $jour_semaine): static
    {
        $this->jour_semaine = $jour_semaine;

        return $this;
    }

    public function getOuvertureMatin(): ?\DateTimeInterface
    {
        return $this->ouverture_matin;
    }

    public function setOuvertureMatin(\DateTimeInterface $ouverture_matin): static
    {
        $this->ouverture_matin = $ouverture_matin;

        return $this;
    }

    public function getFermetureMatin(): ?\DateTimeInterface
    {
        return $this->fermeture_matin;
    }

    public function setFermetureMatin(\DateTimeInterface $fermeture_matin): static
    {
        $this->fermeture_matin = $fermeture_matin;

        return $this;
    }

    public function getOuvertureApresMidi(): ?\DateTimeInterface
    {
        return $this->ouverture_apres_midi;
    }

    public function setOuvertureApresMidi(\DateTimeInterface $ouverture_apres_midi): static
    {
        $this->ouverture_apres_midi = $ouverture_apres_midi;

        return $this;
    }

    public function getFermetureApresMidi(): ?\DateTimeInterface
    {
        return $this->fermeture_apres_midi;
    }

    public function setFermetureApresMidi(\DateTimeInterface $fermeture_apres_midi): static
    {
        $this->fermeture_apres_midi = $fermeture_apres_midi;

        return $this;
    }
}