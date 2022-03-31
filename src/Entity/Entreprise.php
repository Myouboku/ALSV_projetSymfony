<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=38)
     */
    private $ENT_rs;

    /**
     * @ORM\Column(type="integer")
     */
    private $ENT_cp;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ENT_ville;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ENT_adresse;

    /**
     * @ORM\Column(type="string", length=38)
     */
    private $ENT_pays;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="Ent_id")
     */
    private $personne;

    /**
     * @ORM\ManyToOne(targetEntity=entrepriseoption::class, inversedBy="entreprises")
     */
    private $Opt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getENTRs(): ?string
    {
        return $this->ENT_rs;
    }

    public function setENTRs(string $ENT_rs): self
    {
        $this->ENT_rs = $ENT_rs;

        return $this;
    }

    public function getENTCp(): ?int
    {
        return $this->ENT_cp;
    }

    public function setENTCp(int $ENT_cp): self
    {
        $this->ENT_cp = $ENT_cp;

        return $this;
    }

    public function getENTVille(): ?string
    {
        return $this->ENT_ville;
    }

    public function setENTVille(string $ENT_ville): self
    {
        $this->ENT_ville = $ENT_ville;

        return $this;
    }

    public function getENTAdresse(): ?string
    {
        return $this->ENT_adresse;
    }

    public function setENTAdresse(string $ENT_adresse): self
    {
        $this->ENT_adresse = $ENT_adresse;

        return $this;
    }

    public function getENTPays(): ?string
    {
        return $this->ENT_pays;
    }

    public function setENTPays(string $ENT_pays): self
    {
        $this->ENT_pays = $ENT_pays;

        return $this;
    }

    

    public function getPersonne(): ?Personne
    {
        return $this->personne;
    }

    public function setPersonne(?Personne $personne): self
    {
        $this->personne = $personne;

        return $this;
    }

    public function getOpt(): ?entrepriseoption
    {
        return $this->Opt;
    }

    public function setOpt(?entrepriseoption $Opt): self
    {
        $this->Opt = $Opt;

        return $this;
    }
}
