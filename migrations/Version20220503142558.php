<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503142558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, personne_id INT DEFAULT NULL, opt_id INT DEFAULT NULL, ent_rs VARCHAR(38) NOT NULL, ent_cp INT NOT NULL, ent_ville VARCHAR(50) NOT NULL, ent_adresse VARCHAR(50) NOT NULL, ent_pays VARCHAR(38) NOT NULL, INDEX IDX_D19FA60A21BD112 (personne_id), INDEX IDX_D19FA60CCEFD70A (opt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_option (id INT AUTO_INCREMENT NOT NULL, opt_libelle VARCHAR(38) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, fon_libelle VARCHAR(38) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, per_nom VARCHAR(38) NOT NULL, per_prenom VARCHAR(38) DEFAULT NULL, per_mail VARCHAR(50) DEFAULT NULL, per_tel INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_fonction (personne_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_CAD2D4F8A21BD112 (personne_id), INDEX IDX_CAD2D4F857889920 (fonction_id), PRIMARY KEY(personne_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_profil (id INT AUTO_INCREMENT NOT NULL, per_id INT NOT NULL, pro_id INT DEFAULT NULL, annee INT NOT NULL, INDEX IDX_D2AC8A7AB304206A (per_id), INDEX IDX_D2AC8A7AC3B7E4BA (pro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, pro_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, uti_username VARCHAR(38) NOT NULL, uti_mdp VARCHAR(64) NOT NULL, uti_role CHAR(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60CCEFD70A FOREIGN KEY (opt_id) REFERENCES entreprise_option (id)');
        $this->addSql('ALTER TABLE personne_fonction ADD CONSTRAINT FK_CAD2D4F8A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_fonction ADD CONSTRAINT FK_CAD2D4F857889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_profil ADD CONSTRAINT FK_D2AC8A7AB304206A FOREIGN KEY (per_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE personne_profil ADD CONSTRAINT FK_D2AC8A7AC3B7E4BA FOREIGN KEY (pro_id) REFERENCES profil (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60CCEFD70A');
        $this->addSql('ALTER TABLE personne_fonction DROP FOREIGN KEY FK_CAD2D4F857889920');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60A21BD112');
        $this->addSql('ALTER TABLE personne_fonction DROP FOREIGN KEY FK_CAD2D4F8A21BD112');
        $this->addSql('ALTER TABLE personne_profil DROP FOREIGN KEY FK_D2AC8A7AB304206A');
        $this->addSql('ALTER TABLE personne_profil DROP FOREIGN KEY FK_D2AC8A7AC3B7E4BA');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_option');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE personne_fonction');
        $this->addSql('DROP TABLE personne_profil');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE utilisateur');
    }
}
