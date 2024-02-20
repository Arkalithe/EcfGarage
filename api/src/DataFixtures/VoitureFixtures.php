<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Voiture;

class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i <= 5; $i++) {
            $voiture = new Voiture();
            $voiture->setPrix(mt_rand(10000, 50000)); 
            $voiture->setYear(mt_rand(2010, 2022)); 
            $voiture->setPath('image' . $i . '.jpg'); 
            $manager->persist($voiture);
        }


        $manager->flush();
    }
}