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
    private $per_id;

    /**
     * @ORM\ManyToOne(targetEntity=profil::class, inversedBy="personneProfils")
     */
    private $pro_id;

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
        return $this->per_id;
    }

    public function setPerId(?personne $per_id): self
    {
        $this->per_id = $per_id;

        return $this;
    }

    public function getProId(): ?profil
    {
        return $this->pro_id;
    }

    public function setProId(?profil $pro_id): self
    {
        $this->pro_id = $pro_id;

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
