<?php

namespace App\Entity;

use App\Repository\EntrepriseOptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseOptionRepository::class)
 */
class EntrepriseOption
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
    private $opt_libelle;

    /**
     * @ORM\OneToMany(targetEntity=Entreprise::class, mappedBy="opt_id")
     */
    private $entreprises;

    public function __construct()
    {
        $this->entreprises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOptLibelle(): ?string
    {
        return $this->opt_libelle;
    }

    public function setOptLibelle(string $opt_libelle): self
    {
        $this->opt_libelle = $opt_libelle;

        return $this;
    }

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises[] = $entreprise;
            $entreprise->setOptId($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        if ($this->entreprises->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getOptId() === $this) {
                $entreprise->setOptId(null);
            }
        }

        return $this;
    }
}
