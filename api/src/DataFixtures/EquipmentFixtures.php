<?php


namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Equipement;

class EquipementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $equipements = [
            'GPS',
            'Climatisation',
            'Régulateur de vitesse',
            'Sièges chauffants',
            'Toit ouvrant'
        ];

        foreach ($equipements as $name) {
            $equipement = new Equipement();
            $equipement->setName($name);
            $manager->persist($equipement);
        }

        $manager->flush();
    }
}
