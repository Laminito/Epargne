<?php

namespace App\Entity;

use App\Entity\AdminGroup;
use App\Entity\SuperAdmin;
use App\Entity\Gestionnaires;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\AdminGroupRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AdminGroupRepository::class)]
#[ApiResource(
    collectionOperations:   [
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['adg:read:simple']],
        ],

        "post"=>[
            'method' => 'post',
            'normalization_context'   => ['groups' => ['adg:read:all']],
            'denormalization_context' => ['groups' => ['adg:write']],
        ]
    ],
    itemOperations: ["get","put","delete"]
)]
class AdminGroup extends Gestionnaires
{
    #[ORM\ManyToOne(inversedBy: 'super_admin')]
    private ?SuperAdmin $superAdmin = null;

    public function getSuperAdmin(): ?SuperAdmin
    {
        return $this->superAdmin;
    }

    public function setSuperAdmin(?SuperAdmin $superAdmin): self
    {
        $this->superAdmin = $superAdmin;

        return $this;
    }
}
