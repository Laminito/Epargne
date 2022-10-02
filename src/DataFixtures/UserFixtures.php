<?php

namespace App\DataFixtures;

use App\Entity\SuperAdmin;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hashedPassword;

    public function __construct(UserPasswordHasherInterface $hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }

    public function load(ObjectManager $manager): void
    {
        $sa = new SuperAdmin();
        $sa->setEmail('superadmin@epargne.odc');
        $hashedPassword = $this->hashedPassword->hashPassword($sa,'passer');
        $sa->setPassword($hashedPassword);
        $sa->setRoles(['SUPER_ADMIN']);
        // $sa->setPrenom('Mohamed Ba');
        

        // $user1= new Gestionnaires();
        // $user1->setEmail('gestionnaire@example.com');
        // $hashedPassword = $this->hashedPassword->hashPassword($user1,'passer');
        // $user1->setPassword($hashedPassword);
        // $user1->setRoles(['ROLE_GESTIONNAIRE']);

        $manager->persist($sa);
        $manager->persist($sa);
        $manager->flush();

    }
}
