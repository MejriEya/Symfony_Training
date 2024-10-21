<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteRepository::class)]
class Compte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NumC = null;

    #[ORM\Column(length: 255)]
    private ?string $solde = null;

    #[ORM\Column(length: 255)]
    private ?string $dateCreation = null;

    #[ORM\ManyToOne(inversedBy: 'comptes')]
    private ?Client $relation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumC(): ?string
    {
        return $this->NumC;
    }

    public function setNumC(string $NumC): static
    {
        $this->NumC = $NumC;

        return $this;
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): static
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDateCreation(): ?string
    {
        return $this->dateCreation;
    }

    public function setDateCreation(string $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getRelation(): ?Client
    {
        return $this->relation;
    }

    public function setRelation(?Client $relation): static
    {
        $this->relation = $relation;

        return $this;
    }
}
