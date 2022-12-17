<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221217171237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etablissements (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(150) NOT NULL, slug VARCHAR(128) NOT NULL, forme_juridique VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, num_decision_creation VARCHAR(60) NOT NULL, num_decision_ouverture VARCHAR(60) NOT NULL, date_ouverture DATE DEFAULT NULL, num_social VARCHAR(60) DEFAULT NULL, num_fiscal VARCHAR(60) DEFAULT NULL, telephone VARCHAR(25) NOT NULL, telephone_mobile VARCHAR(25) DEFAULT NULL, cpte_bancaire VARCHAR(100) DEFAULT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE etablissements');
    }
}
