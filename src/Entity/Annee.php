<?php

namespace App\Entity;

use App\Repository\AnneeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnneeRepository::class)
 */
class Annee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ANNEE_libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Annee::class, inversedBy="annees")
     */
    private $Annee_id;

    /**
     * @ORM\ManyToMany(targetEntity=Annee::class, mappedBy="Annee_id")
     */
    private $annees;

    public function __construct()
    {
        $this->Annee_id = new ArrayCollection();
        $this->annees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getANNEELibelle(): ?int
    {
        return $this->ANNEE_libelle;
    }

    public function setANNEELibelle(?int $ANNEE_libelle): self
    {
        $this->ANNEE_libelle = $ANNEE_libelle;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAnneeId(): Collection
    {
        return $this->Annee_id;
    }

    public function addAnneeId(self $anneeId): self
    {
        if (!$this->Annee_id->contains($anneeId)) {
            $this->Annee_id[] = $anneeId;
        }

        return $this;
    }

    public function removeAnneeId(self $anneeId): self
    {
        $this->Annee_id->removeElement($anneeId);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAnnees(): Collection
    {
        return $this->annees;
    }

    public function addAnnee(self $annee): self
    {
        if (!$this->annees->contains($annee)) {
            $this->annees[] = $annee;
            $annee->addAnneeId($this);
        }

        return $this;
    }

    public function removeAnnee(self $annee): self
    {
        if ($this->annees->removeElement($annee)) {
            $annee->removeAnneeId($this);
        }

        return $this;
    }
}
