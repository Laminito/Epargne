<?php

namespace App\Entity;

use App\Entity\Member;
use App\Entity\Person;
use App\Entity\AdminGroup;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\MemberRepository;
use ApiPlatform\Metadata\ApiResource;
// use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping\GeneratedValue;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ApiResource(
    collectionOperations:   [
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['mb:read:simple']],
        ],

        "post"=>[
            'method' => 'post',
            'normalization_context'   => ['groups' => ['mb:read:all']],
            'denormalization_context' => ['groups' => ['mb:write']],
        ]
    ],
    itemOperations: ["get","put"]
)]
class Member extends Person
{
    #[ORM\Column(nullable: true)]
    #[Groups(['adg:read:simple'])]
    private ?int $matricule = null;

    #[ORM\ManyToOne(inversedBy: 'members')]
    private ?AdminGroup $admin_group = null;

    public function __construct(){
        $this->matricule=rand(1000000,9999999);
    }

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(?int $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getAdminGroup(): ?AdminGroup
    {
        return $this->admin_group;
    }

    public function setAdminGroup(?AdminGroup $admin_group): self
    {
        $this->admin_group = $admin_group;

        return $this;
    }
}
