<?php

namespace App\Entity;

use App\Entity\Gestionnaires;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\AdminGroupRepository;

#[ORM\Entity(repositoryClass: AdminGroupRepository::class)]
#[ApiResource]
class AdminGroup extends Gestionnaires
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
