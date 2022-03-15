<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 */
class Personne
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
    private $per_nom;

    /**
     * @ORM\Column(type="string", length=38)
     */
    private $per_prenom;

    /**
     * @ORM\Column(type="string", length=50 nullable=true)
     */
    private $per_mail;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $per_tel;

    /**
     * @ORM\ManyToMany(targetEntity=fonction::class, inversedBy="personnes", )
     */
    private $FON_id;

    /**
     * @ORM\ManyToMany(targetEntity=Profil::class, inversedBy="personnes")
     */
    private $PRO_id;

    /**
     * @ORM\OneToMany(targetEntity=Entreprise::class, mappedBy="personne")
     */
    private $Ent_id;

    public function __construct()
    {
        $this->FON_id = new ArrayCollection();
        $this->PRO_id = new ArrayCollection();
        $this->Ent_id = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerNom(): ?string
    {
        return $this->per_nom;
    }

    public function setPerNom(string $per_nom): self
    {
        $this->per_nom = $per_nom;

        return $this;
    }

    public function getPerPrenom(): ?string
    {
        return $this->per_prenom;
    }

    public function setPerPrenom(string $per_prenom): self
    {
        $this->per_prenom = $per_prenom;

        return $this;
    }

    public function getPerMail(): ?string
    {
        return $this->per_mail;
    }

    public function setPerMail(string $per_mail): self
    {
        $this->per_mail = $per_mail;

        return $this;
    }

    public function getPerTel(): ?int
    {
        return $this->per_tel;
    }

    public function setPerTel(int $per_tel): self
    {
        $this->per_tel = $per_tel;

        return $this;
    }

    /**
     * @return Collection<int, fonction>
     */
    public function getFONId(): Collection
    {
        return $this->FON_id;
    }

    public function addFONId(fonction $fONId): self
    {
        if (!$this->FON_id->contains($fONId)) {
            $this->FON_id[] = $fONId;
        }

        return $this;
    }

    public function removeFONId(fonction $fONId): self
    {
        $this->FON_id->removeElement($fONId);

        return $this;
    }

    /**
     * @return Collection<int, Profil>
     */
    public function getPROId(): Collection
    {
        return $this->PRO_id;
    }

    public function addPROId(Profil $pROId): self
    {
        if (!$this->PRO_id->contains($pROId)) {
            $this->PRO_id[] = $pROId;
        }

        return $this;
    }

    public function removePROId(Profil $pROId): self
    {
        $this->PRO_id->removeElement($pROId);

        return $this;
    }

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntId(): Collection
    {
        return $this->Ent_id;
    }

    public function addEntId(Entreprise $entId): self
    {
        if (!$this->Ent_id->contains($entId)) {
            $this->Ent_id[] = $entId;
            $entId->setPersonne($this);
        }

        return $this;
    }

    public function removeEntId(Entreprise $entId): self
    {
        if ($this->Ent_id->removeElement($entId)) {
            // set the owning side to null (unless already changed)
            if ($entId->getPersonne() === $this) {
                $entId->setPersonne(null);
            }
        }

        return $this;
    }


}
