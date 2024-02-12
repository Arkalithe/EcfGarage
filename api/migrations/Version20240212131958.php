<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240212131958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voiture_caracteristique (voiture_id INT NOT NULL, caracteristique_id INT NOT NULL, INDEX IDX_12CE44C9181A8BA (voiture_id), INDEX IDX_12CE44C91704EEB7 (caracteristique_id), PRIMARY KEY(voiture_id, caracteristique_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE voiture_equipement (voiture_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_C99F3755181A8BA (voiture_id), INDEX IDX_C99F3755806F0F5C (equipement_id), PRIMARY KEY(voiture_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE voiture_caracteristique ADD CONSTRAINT FK_12CE44C9181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE voiture_caracteristique ADD CONSTRAINT FK_12CE44C91704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id)');
        $this->addSql('ALTER TABLE voiture_equipement ADD CONSTRAINT FK_C99F3755181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE voiture_equipement ADD CONSTRAINT FK_C99F3755806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE voiture DROP caracteristique, DROP equipement');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture_caracteristique DROP FOREIGN KEY FK_12CE44C9181A8BA');
        $this->addSql('ALTER TABLE voiture_caracteristique DROP FOREIGN KEY FK_12CE44C91704EEB7');
        $this->addSql('ALTER TABLE voiture_equipement DROP FOREIGN KEY FK_C99F3755181A8BA');
        $this->addSql('ALTER TABLE voiture_equipement DROP FOREIGN KEY FK_C99F3755806F0F5C');
        $this->addSql('DROP TABLE voiture_caracteristique');
        $this->addSql('DROP TABLE voiture_equipement');
        $this->addSql('ALTER TABLE voiture ADD caracteristique VARCHAR(255) NOT NULL, ADD equipement VARCHAR(255) NOT NULL');
    }
}
