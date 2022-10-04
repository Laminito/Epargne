<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: PersonRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type", type:"string")]
#[ORM\DiscriminatorMap([
    "super_admin" => "SuperAdmin",
    "admin_group" => "AdminGroup",
    "membre"=>"Member",
])]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['adg:read:simple'])]
    protected ?int $id = null;

    // #[Groups(['spa:read:simple'])]
    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['adg:read:simple','adg:write','spa:read:simple','spa:write','adg:read:simple'])]
    protected ?string $prenom = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['adg:read:simple','adg:write','spa:read:simple','spa:write','adg:read:simple'])]
    protected ?string $nom = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['adg:read:simple','adg:write','spa:read:simple','spa:write','adg:read:simple'])]
    protected ?string $telephone = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['adg:read:simple','adg:write','spa:read:simple','spa:write','adg:read:simple'])]
    protected ?string $adresse = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['adg:read:simple','adg:write','spa:read:simple','spa:write','adg:read:simple'])]
    protected ?int $cni = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['adg:read:simple','adg:write','spa:read:simple','spa:write','adg:read:simple'])]
    protected ?string $sexe = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    #[Groups(['adg:read:simple','adg:write','spa:read:simple','spa:write','adg:read:simple'])]
    protected $avatar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCni(): ?int
    {
        return $this->cni;
    }

    public function setCni(?int $cni): self
    {
        $this->cni = $cni;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
