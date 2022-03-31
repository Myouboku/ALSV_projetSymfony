<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
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
     * @ORM\Column(type="string", length=38)
     */
    private $UTI_username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $UTI_mdp;

    /**
     * @ORM\Column(type="string", length=38)
     */
    private $uti_role;



    public function getId(): ?int
    {
        return $this->id;
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

    public function getUTIMdp(): ?string
    {
        return $this->UTI_mdp;
    }

    public function setUTIMdp(string $UTI_mdp): self
    {
        $this->UTI_mdp = $UTI_mdp;

        return $this;
    }

    public function getUtiRole(): ?string
    {
        return $this->uti_role;
    }

    public function setUtiRole(string $uti_role): self
    {
        $this->uti_role = $uti_role;

        return $this;
    }

}
