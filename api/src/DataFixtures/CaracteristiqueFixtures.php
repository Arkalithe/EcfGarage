<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Caracteristique;
use App\Entity\Equipement;
use App\Entity\Avis;
use App\Entity\Horaire;
use App\Entity\Voiture;
use App\Entity\Employe;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CaracteristiqueFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $caracteristiques = [
            'Puissance',
            'Consommation',
            'Capacité du coffre',
            'Nombre de places',
            'Couleur'
        ];

        $equipements = [
            'GPS',
            'Climatisation',
            'Régulateur de vitesse',
            'Sièges chauffants',
            'Toit ouvrant'
        ];

        $horaires = [
            'Lundi' => ['08:00', '12:00', '14:00', '18:00'],
            'Mardi' => ['08:00', '12:00', '14:00', '18:00'],
            'Mercredi' => ['08:00', '12:00', '14:00', '18:00'],
            'Jeudi' => ['08:00', '12:00', '14:00', '18:00'],
            'Vendredi' => ['08:00', '12:00', '14:00', '18:00'],
            'Samedi' => ['09:00', '12:00', '14:00', '17:00'],
            'Dimanche' => ['fermé', 'fermé', 'fermé', 'fermé']
        ];

        foreach ($caracteristiques as $name) {
            $caracteristique = new Caracteristique();
            $caracteristique->setName($name);
            $manager->persist($caracteristique);
        }

        foreach ($equipements as $name) {
            $equipement = new Equipement();
            $equipement->setName($name);
            $manager->persist($equipement);
        }
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $avis = new Avis();
            $avis->setNom($faker->name);
            $avis->setMessage($faker->sentence);
            $avis->setRating(mt_rand(0, 5));
            $avis->setModerate(mt_rand(0,1));
            $manager->persist($avis);
        }

        foreach ($horaires as $jour => $heures) {
            $horaire = new Horaire();
            $horaire->setJourSemaine($jour);

            if ($heures[0] !== 'fermé') {
                $horaire->setOuvertureMatin(\DateTime::createFromFormat('H:i', $heures[0]));
                $horaire->setFermetureMatin(\DateTime::createFromFormat('H:i', $heures[1]));
                $horaire->setOuvertureApresMidi(\DateTime::createFromFormat('H:i', $heures[2]));
                $horaire->setFermetureApresMidi(\DateTime::createFromFormat('H:i', $heures[3]));
            } else {
                $horaire->setOuvertureMatin(new \DateTime('00:00'));
                $horaire->setFermetureMatin(new \DateTime('00:00'));
                $horaire->setOuvertureApresMidi(new \DateTime('00:00'));
                $horaire->setFermetureApresMidi(new \DateTime('00:00'));
            }

            $manager->persist($horaire);
        }
        $manager->flush();

        $voitures = [];
        for ($i = 0; $i < 5; $i++) {
            $voiture = new Voiture();
            $voiture->setPrix(mt_rand(10000, 50000));
            $voiture->setYear(mt_rand(2000, 2024));
            $voiture->setPath('image' . $voiture->getId() . '.png');
            $manager->persist($voiture);
            $voitures[] = $voiture;

            $caracteristiques = $manager->getRepository(Caracteristique::class)->findAll();
            $equipements = $manager->getRepository(Equipement::class)->findAll();

            foreach ($voitures as $voiture) {
                shuffle($caracteristiques);
                shuffle($equipements);
                $caracteristiquesToAdd = array_slice($caracteristiques, 0, 2);
                $equipementsToAdd = array_slice($equipements, 0, 2);

                foreach ($caracteristiquesToAdd as $caracteristique) {
                    if (rand(0, 1)) {
                        $voiture->getCaracteristique()->add($caracteristique);
                    }
                }
                foreach ($equipementsToAdd as $equipement) {
                    if (rand(0, 1)) {
                        $voiture->getEquipement()->add($equipement);
                    }
                }
            }
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

            $employe = new Employe();
            $employe->setLastname("momo");
            $employe->setFirstname("momo");
            $employe->setMail("momo@momo.momo");
            $employe->setRoles("Admin");
            $plainPassword = 'Momomo0*' . $i;
            $hashedPassword = $this->passwordEncoder->hashPassword($employe, $plainPassword);
            $employe->setPassword($hashedPassword);


            $manager->persist($employe);
            $manager->flush();
        }
    }
}
