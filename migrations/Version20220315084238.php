<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315084238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercer_fonction DROP FOREIGN KEY FK_F99A7030FB4758AE');
        $this->addSql('ALTER TABLE exercer_personne DROP FOREIGN KEY FK_FF546C62FB4758AE');
        $this->addSql('DROP TABLE exercer');
        $this->addSql('DROP TABLE exercer_fonction');
        $this->addSql('DROP TABLE exercer_personne');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercer (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE exercer_fonction (exercer_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_F99A703057889920 (fonction_id), INDEX IDX_F99A7030FB4758AE (exercer_id), PRIMARY KEY(exercer_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE exercer_personne (exercer_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_FF546C62A21BD112 (personne_id), INDEX IDX_FF546C62FB4758AE (exercer_id), PRIMARY KEY(exercer_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE exercer_fonction ADD CONSTRAINT FK_F99A703057889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercer_fonction ADD CONSTRAINT FK_F99A7030FB4758AE FOREIGN KEY (exercer_id) REFERENCES exercer (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercer_personne ADD CONSTRAINT FK_FF546C62A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercer_personne ADD CONSTRAINT FK_FF546C62FB4758AE FOREIGN KEY (exercer_id) REFERENCES exercer (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise CHANGE ent_rs ent_rs VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_ville ent_ville VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_adresse ent_adresse VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_pays ent_pays VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE fonction CHANGE fon_libelle fon_libelle VARCHAR(38) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `option` CHANGE opt_libelle opt_libelle VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE personne CHANGE per_nom per_nom VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE per_prenom per_prenom VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE per_mail per_mail VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE profil CHANGE pro_libelle pro_libelle VARCHAR(38) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE role CHANGE rol_libelle rol_libelle VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE utilisateur CHANGE uti_mdp uti_mdp VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE uti_username uti_username VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
