<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221217175200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personnels (id INT AUTO_INCREMENT NOT NULL, nom_id INT NOT NULL, prenom_id INT NOT NULL, lieu_naissance_id INT NOT NULL, profession_id INT NOT NULL, niveau_etude_id INT NOT NULL, departement_id INT NOT NULL, sexe VARCHAR(1) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(25) DEFAULT NULL, situation_matrimoniale VARCHAR(12) NOT NULL, nb_enfants INT DEFAULT NULL, full_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7AC38C2BC8121CE9 (nom_id), INDEX IDX_7AC38C2B58819F9E (prenom_id), INDEX IDX_7AC38C2B38C8067D (lieu_naissance_id), INDEX IDX_7AC38C2BFDEF8996 (profession_id), INDEX IDX_7AC38C2BFEAD13D1 (niveau_etude_id), INDEX IDX_7AC38C2BCCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnels_specialites (personnels_id INT NOT NULL, specialites_id INT NOT NULL, INDEX IDX_4B6A7D68C7022806 (personnels_id), INDEX IDX_4B6A7D685AEDDAD9 (specialites_id), PRIMARY KEY(personnels_id, specialites_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnels_etablissements (personnels_id INT NOT NULL, etablissements_id INT NOT NULL, INDEX IDX_64685476C7022806 (personnels_id), INDEX IDX_64685476D23B76CD (etablissements_id), PRIMARY KEY(personnels_id, etablissements_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnels ADD CONSTRAINT FK_7AC38C2BC8121CE9 FOREIGN KEY (nom_id) REFERENCES noms (id)');
        $this->addSql('ALTER TABLE personnels ADD CONSTRAINT FK_7AC38C2B58819F9E FOREIGN KEY (prenom_id) REFERENCES prenoms (id)');
        $this->addSql('ALTER TABLE personnels ADD CONSTRAINT FK_7AC38C2B38C8067D FOREIGN KEY (lieu_naissance_id) REFERENCES lieu_naissances (id)');
        $this->addSql('ALTER TABLE personnels ADD CONSTRAINT FK_7AC38C2BFDEF8996 FOREIGN KEY (profession_id) REFERENCES professions (id)');
        $this->addSql('ALTER TABLE personnels ADD CONSTRAINT FK_7AC38C2BFEAD13D1 FOREIGN KEY (niveau_etude_id) REFERENCES niveau_etudes (id)');
        $this->addSql('ALTER TABLE personnels ADD CONSTRAINT FK_7AC38C2BCCF9E01E FOREIGN KEY (departement_id) REFERENCES departements (id)');
        $this->addSql('ALTER TABLE personnels_specialites ADD CONSTRAINT FK_4B6A7D68C7022806 FOREIGN KEY (personnels_id) REFERENCES personnels (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnels_specialites ADD CONSTRAINT FK_4B6A7D685AEDDAD9 FOREIGN KEY (specialites_id) REFERENCES specialites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnels_etablissements ADD CONSTRAINT FK_64685476C7022806 FOREIGN KEY (personnels_id) REFERENCES personnels (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnels_etablissements ADD CONSTRAINT FK_64685476D23B76CD FOREIGN KEY (etablissements_id) REFERENCES etablissements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users ADD personnels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9C7022806 FOREIGN KEY (personnels_id) REFERENCES personnels (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9C7022806 ON users (personnels_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9C7022806');
        $this->addSql('ALTER TABLE personnels DROP FOREIGN KEY FK_7AC38C2BC8121CE9');
        $this->addSql('ALTER TABLE personnels DROP FOREIGN KEY FK_7AC38C2B58819F9E');
        $this->addSql('ALTER TABLE personnels DROP FOREIGN KEY FK_7AC38C2B38C8067D');
        $this->addSql('ALTER TABLE personnels DROP FOREIGN KEY FK_7AC38C2BFDEF8996');
        $this->addSql('ALTER TABLE personnels DROP FOREIGN KEY FK_7AC38C2BFEAD13D1');
        $this->addSql('ALTER TABLE personnels DROP FOREIGN KEY FK_7AC38C2BCCF9E01E');
        $this->addSql('ALTER TABLE personnels_specialites DROP FOREIGN KEY FK_4B6A7D68C7022806');
        $this->addSql('ALTER TABLE personnels_specialites DROP FOREIGN KEY FK_4B6A7D685AEDDAD9');
        $this->addSql('ALTER TABLE personnels_etablissements DROP FOREIGN KEY FK_64685476C7022806');
        $this->addSql('ALTER TABLE personnels_etablissements DROP FOREIGN KEY FK_64685476D23B76CD');
        $this->addSql('DROP TABLE personnels');
        $this->addSql('DROP TABLE personnels_specialites');
        $this->addSql('DROP TABLE personnels_etablissements');
        $this->addSql('DROP INDEX IDX_1483A5E9C7022806 ON users');
        $this->addSql('ALTER TABLE users DROP personnels_id');
    }
}
