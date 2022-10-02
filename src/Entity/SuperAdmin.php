<?php

namespace App\Entity;

use App\Entity\AdminGroup;
use App\Entity\SuperAdmin;
use App\Entity\Gestionnaires;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use App\Repository\SuperAdminRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: SuperAdminRepository::class)]

#[ApiResource(
    collectionOperations:   [
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['spa:read:simple']],
        ],

        "post"=>[
            'method' => 'post',
            'normalization_context'   => ['groups' => ['spa:read:all']],
            'denormalization_context' => ['groups' => ['spa:write']],
        ]
    ],
    itemOperations: ["get","put","delete"]
)]


class SuperAdmin extends Gestionnaires
{
    #[ORM\OneToMany(mappedBy: 'superAdmin', targetEntity: AdminGroup::class)]
    private Collection $super_admin;

    public function __construct()
    {
        $this->super_admin = new ArrayCollection();
    }

    /**
     * @return Collection<int, AdminGroup>
     */
    public function getSuperAdmin(): Collection
    {
        return $this->super_admin;
    }

    public function addSuperAdmin(AdminGroup $superAdmin): self
    {
        if (!$this->super_admin->contains($superAdmin)) {
            $this->super_admin->add($superAdmin);
            $superAdmin->setSuperAdmin($this);
        }

        return $this;
    }

    public function removeSuperAdmin(AdminGroup $superAdmin): self
    {
        if ($this->super_admin->removeElement($superAdmin)) {
            // set the owning side to null (unless already changed)
            if ($superAdmin->getSuperAdmin() === $this) {
                $superAdmin->setSuperAdmin(null);
            }
        }

        return $this;
    }
}
