<?php

namespace App\Entity;

use App\Entity\Gestionnaires;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\SuperAdminRepository;

#[ORM\Entity(repositoryClass: SuperAdminRepository::class)]
#[ApiResource]
class SuperAdmin extends Gestionnaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
