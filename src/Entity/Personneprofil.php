<?php

namespace App\Entity;

use App\Repository\PersonneprofilRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonneprofilRepository::class)
 */
class Personneprofil
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
    private $annnee;

    /**
     * @ORM\ManyToOne(targetEntity=personne::class, inversedBy="personneprofils")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pers;

    /**
     * @ORM\ManyToOne(targetEntity=profil::class, inversedBy="personneprofils")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnnee(): ?int
    {
        return $this->annnee;
    }

    public function setAnnnee(int $annnee): self
    {
        $this->annnee = $annnee;

        return $this;
    }

    public function getPers(): ?personne
    {
        return $this->pers;
    }

    public function setPers(?personne $pers): self
    {
        $this->pers = $pers;

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
