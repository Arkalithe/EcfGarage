<?php

namespace App\DataFixtures;

use App\Entity\Employe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EmployeFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $employe = new Employe();
            $employe->setLastname("Doe" . $i);
            $employe->setFirstname("John" . $i);
            $employe->setMail("john" . $i . "@example.com");
            $employe->setRoles("Employe");
            $plainPassword = 'password' . $i;
            $hashedPassword = $this->passwordEncoder->hashPassword($employe, $plainPassword);
            $employe->setPassword($hashedPassword);


            $manager->persist($employe);
        }


        $manager->flush();
    }
}
