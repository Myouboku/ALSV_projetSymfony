<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $UTI_mdp;

    /**
     * @ORM\Column(type="string", length=38)
     */
    private $UTI_username;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, inversedBy="utilisateurs")
     */
    private $ROL_id;

    public function __construct()
    {
        $this->ROL_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUTIMdp(): ?string
    {
        return $this->UTI_mdp;
    }

    public function setUTIMdp(string $UTI_mdp): self
    {
        $this->UTI_mdp = $UTI_mdp;

        return $this;
    }

    public function getUTIUsername(): ?string
    {
        return $this->UTI_username;
    }

    public function setUTIUsername(string $UTI_username): self
    {
        $this->UTI_username = $UTI_username;

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getROLId(): Collection
    {
        return $this->ROL_id;
    }

    public function addROLId(Role $rOLId): self
    {
        if (!$this->ROL_id->contains($rOLId)) {
            $this->ROL_id[] = $rOLId;
        }

        return $this;
    }

    public function removeROLId(Role $rOLId): self
    {
        $this->ROL_id->removeElement($rOLId);

        return $this;
    }
}
