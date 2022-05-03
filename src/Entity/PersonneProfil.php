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
     * @ORM\ManyToOne(targetEntity=personne::class, inversedBy="personneProfils")
     * @ORM\JoinColumn(nullable=false)
     */
    private $per;

    /**
     * @ORM\ManyToOne(targetEntity=profil::class, inversedBy="personneProfils")
     */
    private $pro;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerId(): ?personne
    {
        return $this->per;
    }

    public function setPerId(?personne $per): self
    {
        $this->per = $per;

        return $this;
    }

    public function getProId(): ?profil
    {
        return $this->pro;
    }

    public function setProId(?profil $pro): self
    {
        $this->pro = $pro;

        return $this;
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
}
