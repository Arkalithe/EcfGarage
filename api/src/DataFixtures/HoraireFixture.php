<?php 
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Horaire;

class HoraireFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $horaires = [
            'Lundi' => ['08:00', '12:00', '14:00', '18:00'],
            'Mardi' => ['08:00', '12:00', '14:00', '18:00'],
            'Mercredi' => ['08:00', '12:00', '14:00', '18:00'],
            'Jeudi' => ['08:00', '12:00', '14:00', '18:00'],
            'Vendredi' => ['08:00', '12:00', '14:00', '18:00'],
            'Samedi' => ['09:00', '12:00', '14:00', '17:00'],
            'Dimanche' => ['fermé', 'fermé', 'fermé', 'fermé'] 
        ];

        
        foreach ($horaires as $jour => $heures) {
            $horaire = new Horaire();
            $horaire->setJourSemaine($jour);

            if ($heures[0] !== 'fermé') {
                $horaire->setOuvertureMatin(\DateTime::createFromFormat('H:i', $heures[0]));
                $horaire->setFermetureMatin(\DateTime::createFromFormat('H:i', $heures[1]));
                $horaire->setOuvertureApresMidi(\DateTime::createFromFormat('H:i', $heures[2]));
                $horaire->setFermetureApresMidi(\DateTime::createFromFormat('H:i', $heures[3]));
            }

            $manager->persist($horaire);
        }        
        $manager->flush();
    }
}