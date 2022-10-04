<?php

namespace App\Entity;


use App\Entity\Member;
use App\Entity\AdminGroup;
use App\Entity\SuperAdmin;
use App\Entity\Gestionnaires;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use App\Repository\AdminGroupRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
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

    #[ORM\OneToMany(mappedBy: 'admin_group', targetEntity: Member::class)]
    private Collection $members;

    public function __construct()
    {
        $this->members = new ArrayCollection();
    }


    public function getSuperAdmin(): ?SuperAdmin
    {
        return $this->superAdmin;
    }

    public function setSuperAdmin(?SuperAdmin $superAdmin): self
    {
        $this->superAdmin = $superAdmin;

        return $this;
    }

    /**
     * @return Collection<int, Member>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Member $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members->add($member);
            $member->setAdminGroup($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getAdminGroup() === $this) {
                $member->setAdminGroup(null);
            }
        }

        return $this;
    }
}
