<?php

namespace App\Entity;

use App\Repository\FonctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FonctionRepository::class)
 */
class Fonction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=38, nullable=true)
     */
    private $FON_libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Personne::class, mappedBy="FON_id")
     */
    private $personnes;

    public function __construct()
    {
        $this->exercers = new ArrayCollection();
        $this->personnes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFONLibelle(): ?string
    {
        return $this->FON_libelle;
    }

    public function setFONLibelle(?string $FON_libelle): self
    {
        $this->FON_libelle = $FON_libelle;

        return $this;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(Personne $personne): self
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes[] = $personne;
            $personne->addFONId($this);
        }

        return $this;
    }

    public function removePersonne(Personne $personne): self
    {
        if ($this->personnes->removeElement($personne)) {
            $personne->removeFONId($this);
        }

        return $this;
    }

}
