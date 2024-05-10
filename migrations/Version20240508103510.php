<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508103510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse_livraison ADD pays VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD compagnie VARCHAR(255) NOT NULL, CHANGE user_id user_id INT NOT NULL, CHANGE commentaire_adresse_livr commentaire_adresse_livr VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse_livraison DROP pays, DROP nom, DROP prenom, DROP compagnie, CHANGE user_id user_id INT DEFAULT NULL, CHANGE commentaire_adresse_livr commentaire_adresse_livr VARCHAR(255) DEFAULT NULL');
    }
}
