<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240112155206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse_livraison ADD CONSTRAINT FK_B0B09C9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B0B09C9A76ED395 ON adresse_livraison (user_id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0A76ED395 ON avis (user_id)');
        $this->addSql('ALTER TABLE commande ADD commande_id INT DEFAULT NULL, ADD details_commande_id INT DEFAULT NULL, ADD adresse_facturation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D82EA2E54 FOREIGN KEY (commande_id) REFERENCES adresse_livraison (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DE99004AB FOREIGN KEY (details_commande_id) REFERENCES details_commande (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D5BBD1224 FOREIGN KEY (adresse_facturation_id) REFERENCES adresse_facturation (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D82EA2E54 ON commande (commande_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67DE99004AB ON commande (details_commande_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D5BBD1224 ON commande (adresse_facturation_id)');
        $this->addSql('ALTER TABLE details_commande ADD stock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE details_commande ADD CONSTRAINT FK_4BCD5F6DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4BCD5F6DCD6110 ON details_commande (stock_id)');
        $this->addSql('ALTER TABLE produit CHANGE prix_produit prix_produit NUMERIC(10, 0) NOT NULL, CHANGE stock_dispo stock_dispo DOUBLE PRECISION NOT NULL, CHANGE taille taille DOUBLE PRECISION NOT NULL, CHANGE description_produit prenom_produit VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD adresse_facturation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495BBD1224 FOREIGN KEY (adresse_facturation_id) REFERENCES adresse_facturation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495BBD1224 ON user (adresse_facturation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE details_commande DROP FOREIGN KEY FK_4BCD5F6DCD6110');
        $this->addSql('DROP INDEX UNIQ_4BCD5F6DCD6110 ON details_commande');
        $this->addSql('ALTER TABLE details_commande DROP stock_id');
        $this->addSql('ALTER TABLE produit CHANGE prix_produit prix_produit DOUBLE PRECISION NOT NULL, CHANGE stock_dispo stock_dispo INT NOT NULL, CHANGE taille taille INT NOT NULL, CHANGE prenom_produit description_produit VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE adresse_livraison DROP FOREIGN KEY FK_B0B09C9A76ED395');
        $this->addSql('DROP INDEX IDX_B0B09C9A76ED395 ON adresse_livraison');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('DROP INDEX IDX_8F91ABF0A76ED395 ON avis');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D82EA2E54');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DE99004AB');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D5BBD1224');
        $this->addSql('DROP INDEX IDX_6EEAA67DA76ED395 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67D82EA2E54 ON commande');
        $this->addSql('DROP INDEX UNIQ_6EEAA67DE99004AB ON commande');
        $this->addSql('DROP INDEX UNIQ_6EEAA67D5BBD1224 ON commande');
        $this->addSql('ALTER TABLE commande DROP commande_id, DROP details_commande_id, DROP adresse_facturation_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495BBD1224');
        $this->addSql('DROP INDEX UNIQ_8D93D6495BBD1224 ON user');
        $this->addSql('ALTER TABLE user DROP adresse_facturation_id');
    }
}
