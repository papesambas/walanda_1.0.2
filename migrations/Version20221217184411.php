<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221217184411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contrats (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT NOT NULL, personnel_id INT NOT NULL, designation VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, type VARCHAR(20) NOT NULL, remuneration INT NOT NULL, date_debut DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', date_fin DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', moti_fin_contrat VARCHAR(255) DEFAULT NULL, INDEX IDX_7268396CFF631228 (etablissement_id), INDEX IDX_7268396C1C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contrats ADD CONSTRAINT FK_7268396CFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissements (id)');
        $this->addSql('ALTER TABLE contrats ADD CONSTRAINT FK_7268396C1C109075 FOREIGN KEY (personnel_id) REFERENCES personnels (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contrats DROP FOREIGN KEY FK_7268396CFF631228');
        $this->addSql('ALTER TABLE contrats DROP FOREIGN KEY FK_7268396C1C109075');
        $this->addSql('DROP TABLE contrats');
    }
}
