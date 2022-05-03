<?php

namespace App\Entity;

use App\Repository\PersonneProfilRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonneProfilRepository::class)
 */
class PersonneProfil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity=personne::class, inversedBy="personneprofils")
     * @ORM\JoinColumn(nullable=false)
     */
    private $per;

    /**
     * @ORM\ManyToOne(targetEntity=profil::class, inversedBy="personneprofils")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getPers(): ?personne
    {
        return $this->per;
    }

    public function setPer(?personne $per): self
    {
        $this->per = $per;

        return $this;
    }

    public function getPro(): ?profil
    {
        return $this->pro;
    }

    public function setPro(?profil $pro): self
    {
        $this->pro = $pro;

        return $this;
    }
}
