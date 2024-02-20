<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Caracteristique;

class CaracteristiqueFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $caracteristiques = [
            'Puissance',
            'Consommation',
            'Capacité du coffre',
            'Nombre de places',
            'Couleur'
        ];

        foreach ($caracteristiques as $name) {
            $caracteristique = new Caracteristique();
            $caracteristique->setName($name);
            $manager->persist($caracteristique);
        }

        $manager->flush();
    }
}
