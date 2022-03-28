<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315132804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annee (id INT AUTO_INCREMENT NOT NULL, annee_libelle INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annee_annee (annee_source INT NOT NULL, annee_target INT NOT NULL, INDEX IDX_5BFD38CB084424F (annee_source), INDEX IDX_5BFD38CA96112C0 (annee_target), PRIMARY KEY(annee_source, annee_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, personne_id INT DEFAULT NULL, ent_rs VARCHAR(38) NOT NULL, ent_cp INT NOT NULL, ent_ville VARCHAR(50) NOT NULL, ent_adresse VARCHAR(50) NOT NULL, ent_pays VARCHAR(38) NOT NULL, INDEX IDX_D19FA60A21BD112 (personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_option (entreprise_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_390BC87A4AEAFEA (entreprise_id), INDEX IDX_390BC87A7C41D6F (option_id), PRIMARY KEY(entreprise_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, fon_libelle VARCHAR(38) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, opt_libelle VARCHAR(38) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, per_nom VARCHAR(38) NOT NULL, per_prenom VARCHAR(38) NOT NULL, per_mail VARCHAR(50) NOT NULL, per_tel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_fonction (personne_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_CAD2D4F8A21BD112 (personne_id), INDEX IDX_CAD2D4F857889920 (fonction_id), PRIMARY KEY(personne_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_profil (personne_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_D2AC8A7AA21BD112 (personne_id), INDEX IDX_D2AC8A7A275ED078 (profil_id), PRIMARY KEY(personne_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, pro_libelle VARCHAR(38) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, rol_libelle VARCHAR(38) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, uti_mdp VARCHAR(38) NOT NULL, uti_username VARCHAR(38) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_role (utilisateur_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_9EE8E650FB88E14F (utilisateur_id), INDEX IDX_9EE8E650D60322AC (role_id), PRIMARY KEY(utilisateur_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annee_annee ADD CONSTRAINT FK_5BFD38CB084424F FOREIGN KEY (annee_source) REFERENCES annee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annee_annee ADD CONSTRAINT FK_5BFD38CA96112C0 FOREIGN KEY (annee_target) REFERENCES annee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE entreprise_option ADD CONSTRAINT FK_390BC87A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_option ADD CONSTRAINT FK_390BC87A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_fonction ADD CONSTRAINT FK_CAD2D4F8A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_fonction ADD CONSTRAINT FK_CAD2D4F857889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_profil ADD CONSTRAINT FK_D2AC8A7AA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_profil ADD CONSTRAINT FK_D2AC8A7A275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_role ADD CONSTRAINT FK_9EE8E650FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_role ADD CONSTRAINT FK_9EE8E650D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annee_annee DROP FOREIGN KEY FK_5BFD38CB084424F');
        $this->addSql('ALTER TABLE annee_annee DROP FOREIGN KEY FK_5BFD38CA96112C0');
        $this->addSql('ALTER TABLE entreprise_option DROP FOREIGN KEY FK_390BC87A4AEAFEA');
        $this->addSql('ALTER TABLE personne_fonction DROP FOREIGN KEY FK_CAD2D4F857889920');
        $this->addSql('ALTER TABLE entreprise_option DROP FOREIGN KEY FK_390BC87A7C41D6F');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60A21BD112');
        $this->addSql('ALTER TABLE personne_fonction DROP FOREIGN KEY FK_CAD2D4F8A21BD112');
        $this->addSql('ALTER TABLE personne_profil DROP FOREIGN KEY FK_D2AC8A7AA21BD112');
        $this->addSql('ALTER TABLE personne_profil DROP FOREIGN KEY FK_D2AC8A7A275ED078');
        $this->addSql('ALTER TABLE utilisateur_role DROP FOREIGN KEY FK_9EE8E650D60322AC');
        $this->addSql('ALTER TABLE utilisateur_role DROP FOREIGN KEY FK_9EE8E650FB88E14F');
        $this->addSql('DROP TABLE annee');
        $this->addSql('DROP TABLE annee_annee');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_option');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE personne_fonction');
        $this->addSql('DROP TABLE personne_profil');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_role');
    }
}
