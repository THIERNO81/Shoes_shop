<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518192920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse_livraison DROP pays, DROP nom, DROP prenom, DROP téléphone, DROP compagnie');
        $this->addSql('ALTER TABLE adresse_livraison ADD CONSTRAINT FK_B0B09C9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transporteurs ADD updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transporteurs DROP updated_at');
        $this->addSql('ALTER TABLE adresse_livraison DROP FOREIGN KEY FK_B0B09C9A76ED395');
        $this->addSql('ALTER TABLE adresse_livraison ADD pays VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD téléphone INT NOT NULL, ADD compagnie VARCHAR(255) NOT NULL');
    }
}
