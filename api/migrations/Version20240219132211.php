<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219132211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, rating INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE caracteristique (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_F804D3B95126AC48 (mail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE horaire (id INT AUTO_INCREMENT NOT NULL, jour_semaine VARCHAR(255) NOT NULL, ouverture_matin TIME NOT NULL, fermeture_matin TIME NOT NULL, ouverture_apres_midi TIME NOT NULL, fermeture_apres_midi TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, prix INT NOT NULL, year INT NOT NULL, path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE voiture_caracteristique (voiture_id INT NOT NULL, caracteristique_id INT NOT NULL, INDEX IDX_12CE44C9181A8BA (voiture_id), INDEX IDX_12CE44C91704EEB7 (caracteristique_id), PRIMARY KEY(voiture_id, caracteristique_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE voiture_equipement (voiture_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_C99F3755181A8BA (voiture_id), INDEX IDX_C99F3755806F0F5C (equipement_id), PRIMARY KEY(voiture_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE voiture_caracteristique ADD CONSTRAINT FK_12CE44C9181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE voiture_caracteristique ADD CONSTRAINT FK_12CE44C91704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id)');
        $this->addSql('ALTER TABLE voiture_equipement ADD CONSTRAINT FK_C99F3755181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE voiture_equipement ADD CONSTRAINT FK_C99F3755806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture_caracteristique DROP FOREIGN KEY FK_12CE44C9181A8BA');
        $this->addSql('ALTER TABLE voiture_caracteristique DROP FOREIGN KEY FK_12CE44C91704EEB7');
        $this->addSql('ALTER TABLE voiture_equipement DROP FOREIGN KEY FK_C99F3755181A8BA');
        $this->addSql('ALTER TABLE voiture_equipement DROP FOREIGN KEY FK_C99F3755806F0F5C');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE caracteristique');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE horaire');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('DROP TABLE voiture_caracteristique');
        $this->addSql('DROP TABLE voiture_equipement');
    }
}
