<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314160801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27DCD6110');
        $this->addSql('DROP INDEX IDX_29A5EC27DCD6110 ON produit');
        $this->addSql('ALTER TABLE produit CHANGE stock_id stock_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A17D8957 FOREIGN KEY (stock_produit_id) REFERENCES stock (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27A17D8957 ON produit (stock_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A17D8957');
        $this->addSql('DROP INDEX IDX_29A5EC27A17D8957 ON produit');
        $this->addSql('ALTER TABLE produit CHANGE stock_produit_id stock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_29A5EC27DCD6110 ON produit (stock_id)');
    }
}
