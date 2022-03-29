<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PRO_libelle;

    /**
     * @ORM\OneToMany(targetEntity=PersonneProfil::class, mappedBy="pro_id")
     */
    private $personneProfils;



    public function __construct()
    {
        $this->personneProfils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPROLibelle(): ?string
    {
        return $this->PRO_libelle;
    }

    public function setPROLibelle(string $PRO_libelle): self
    {
        $this->PRO_libelle = $PRO_libelle;

        return $this;
    }

    /**
     * @return Collection<int, PersonneProfil>
     */
    public function getPersonneProfils(): Collection
    {
        return $this->personneProfils;
    }

    public function addPersonneProfil(PersonneProfil $personneProfil): self
    {
        if (!$this->personneProfils->contains($personneProfil)) {
            $this->personneProfils[] = $personneProfil;
            $personneProfil->setProId($this);
        }

        return $this;
    }

    public function removePersonneProfil(PersonneProfil $personneProfil): self
    {
        if ($this->personneProfils->removeElement($personneProfil)) {
            // set the owning side to null (unless already changed)
            if ($personneProfil->getProId() === $this) {
                $personneProfil->setProId(null);
            }
        }

        return $this;
    }

}
