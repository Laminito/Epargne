<?php

namespace App\DataFixtures;


use App\Entity\Member;
use App\Entity\AdminGroup;
use App\Entity\SuperAdmin;
use App\Entity\Gestionnaires;
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


        $ag= new AdminGroup();
        $ag->setEmail('admingroup@epargne.com');
        $hashedPassword = $this->hashedPassword->hashPassword($ag,'passer');
        $ag->setPassword($hashedPassword);
        $ag->setRoles(['ADMIN']);

        $mb= new Member();
        $mb->setPrenom("Awa");
        $mb->setNom("Diop");
        $mb->setAdresse("Pikine");
        $mb->setTelephone("783703310");
        $mb->setCni(194520);
        $mb->setAvatar("https:www.pngall.com/wp-content/uploads/5/Profile-PNG-Clipart.png");
        $mb->setSexe("Femininin");

        $manager->persist($sa);
        $manager->persist($ag);
        $manager->persist($mb);
        $manager->flush();

    }
}
