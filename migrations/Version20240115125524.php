<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240115125524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE couleur ADD CONSTRAINT FK_3C0D87E5F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_3C0D87E5F347EFB ON couleur (produit_id)');
        $this->addSql('ALTER TABLE details_commande CHANGE commande_id commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE details_commande ADD CONSTRAINT FK_4BCD5F682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4BCD5F682EA2E54 ON details_commande (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE couleur DROP FOREIGN KEY FK_3C0D87E5F347EFB');
        $this->addSql('DROP INDEX IDX_3C0D87E5F347EFB ON couleur');
        $this->addSql('ALTER TABLE details_commande DROP FOREIGN KEY FK_4BCD5F682EA2E54');
        $this->addSql('DROP INDEX UNIQ_4BCD5F682EA2E54 ON details_commande');
        $this->addSql('ALTER TABLE details_commande CHANGE commande_id commande_id INT NOT NULL');
    }
}
