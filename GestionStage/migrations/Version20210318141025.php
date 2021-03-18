<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318141025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Stage (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, poste VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, date_expiration DATETIME NOT NULL, date_modification DATETIME NOT NULL, email VARCHAR(255) NOT NULL, societe VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, INDEX IDX_3BDBC6DBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stage_tuteur (stage_id INT NOT NULL, tuteur_id INT NOT NULL, INDEX IDX_CAC883732298D193 (stage_id), INDEX IDX_CAC8837386EC68D8 (tuteur_id), PRIMARY KEY(stage_id, tuteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Stage ADD CONSTRAINT FK_3BDBC6DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE stage_tuteur ADD CONSTRAINT FK_CAC883732298D193 FOREIGN KEY (stage_id) REFERENCES Stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage_tuteur ADD CONSTRAINT FK_CAC8837386EC68D8 FOREIGN KEY (tuteur_id) REFERENCES tuteur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stage_tuteur DROP FOREIGN KEY FK_CAC883732298D193');
        $this->addSql('ALTER TABLE Stage DROP FOREIGN KEY FK_3BDBC6DBCF5E72D');
        $this->addSql('ALTER TABLE stage_tuteur DROP FOREIGN KEY FK_CAC8837386EC68D8');
        $this->addSql('DROP TABLE Stage');
        $this->addSql('DROP TABLE stage_tuteur');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE tuteur');
    }
}
