<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315100330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annee_annee (annee_source INT NOT NULL, annee_target INT NOT NULL, INDEX IDX_5BFD38CB084424F (annee_source), INDEX IDX_5BFD38CA96112C0 (annee_target), PRIMARY KEY(annee_source, annee_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_option (entreprise_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_390BC87A4AEAFEA (entreprise_id), INDEX IDX_390BC87A7C41D6F (option_id), PRIMARY KEY(entreprise_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_profil (personne_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_D2AC8A7AA21BD112 (personne_id), INDEX IDX_D2AC8A7A275ED078 (profil_id), PRIMARY KEY(personne_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_role (utilisateur_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_9EE8E650FB88E14F (utilisateur_id), INDEX IDX_9EE8E650D60322AC (role_id), PRIMARY KEY(utilisateur_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annee_annee ADD CONSTRAINT FK_5BFD38CB084424F FOREIGN KEY (annee_source) REFERENCES annee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annee_annee ADD CONSTRAINT FK_5BFD38CA96112C0 FOREIGN KEY (annee_target) REFERENCES annee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_option ADD CONSTRAINT FK_390BC87A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_option ADD CONSTRAINT FK_390BC87A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_profil ADD CONSTRAINT FK_D2AC8A7AA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_profil ADD CONSTRAINT FK_D2AC8A7A275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_role ADD CONSTRAINT FK_9EE8E650FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_role ADD CONSTRAINT FK_9EE8E650D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise ADD personne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('CREATE INDEX IDX_D19FA60A21BD112 ON entreprise (personne_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE annee_annee');
        $this->addSql('DROP TABLE entreprise_option');
        $this->addSql('DROP TABLE personne_profil');
        $this->addSql('DROP TABLE utilisateur_role');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60A21BD112');
        $this->addSql('DROP INDEX IDX_D19FA60A21BD112 ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP personne_id, CHANGE ent_rs ent_rs VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_ville ent_ville VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_adresse ent_adresse VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_pays ent_pays VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE fonction CHANGE fon_libelle fon_libelle VARCHAR(38) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `option` CHANGE opt_libelle opt_libelle VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE personne CHANGE per_nom per_nom VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE per_prenom per_prenom VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE per_mail per_mail VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE profil CHANGE pro_libelle pro_libelle VARCHAR(38) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE role CHANGE rol_libelle rol_libelle VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE utilisateur CHANGE uti_mdp uti_mdp VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE uti_username uti_username VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
