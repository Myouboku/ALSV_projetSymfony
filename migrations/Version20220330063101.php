<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330063101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, personne_id INT DEFAULT NULL, ent_rs VARCHAR(38) NOT NULL, ent_cp INT NOT NULL, ent_ville VARCHAR(50) NOT NULL, ent_adresse VARCHAR(50) NOT NULL, ent_pays VARCHAR(38) NOT NULL, INDEX IDX_D19FA60A21BD112 (personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_option (entreprise_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_390BC87A4AEAFEA (entreprise_id), INDEX IDX_390BC87A7C41D6F (option_id), PRIMARY KEY(entreprise_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, fon_libelle VARCHAR(38) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, opt_libelle VARCHAR(38) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, per_nom VARCHAR(38) NOT NULL, per_prenom VARCHAR(38) DEFAULT NULL, per_mail VARCHAR(50) DEFAULT NULL, per_tel INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_fonction (personne_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_CAD2D4F8A21BD112 (personne_id), INDEX IDX_CAD2D4F857889920 (fonction_id), PRIMARY KEY(personne_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_profil (id INT AUTO_INCREMENT NOT NULL, per_id_id INT NOT NULL, pro_id_id INT DEFAULT NULL, annee INT NOT NULL, INDEX IDX_D2AC8A7AB1E86BCE (per_id_id), INDEX IDX_D2AC8A7AC19FAEF2 (pro_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, pro_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, uti_username VARCHAR(38) NOT NULL, uti_mdp VARCHAR(64) NOT NULL, uti_role VARCHAR(38) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE entreprise_option ADD CONSTRAINT FK_390BC87A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_option ADD CONSTRAINT FK_390BC87A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_fonction ADD CONSTRAINT FK_CAD2D4F8A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_fonction ADD CONSTRAINT FK_CAD2D4F857889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_profil ADD CONSTRAINT FK_D2AC8A7AB1E86BCE FOREIGN KEY (per_id_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE personne_profil ADD CONSTRAINT FK_D2AC8A7AC19FAEF2 FOREIGN KEY (pro_id_id) REFERENCES profil (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise_option DROP FOREIGN KEY FK_390BC87A4AEAFEA');
        $this->addSql('ALTER TABLE personne_fonction DROP FOREIGN KEY FK_CAD2D4F857889920');
        $this->addSql('ALTER TABLE entreprise_option DROP FOREIGN KEY FK_390BC87A7C41D6F');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60A21BD112');
        $this->addSql('ALTER TABLE personne_fonction DROP FOREIGN KEY FK_CAD2D4F8A21BD112');
        $this->addSql('ALTER TABLE personne_profil DROP FOREIGN KEY FK_D2AC8A7AB1E86BCE');
        $this->addSql('ALTER TABLE personne_profil DROP FOREIGN KEY FK_D2AC8A7AC19FAEF2');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_option');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE personne_fonction');
        $this->addSql('DROP TABLE personne_profil');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE utilisateur');
    }
}
