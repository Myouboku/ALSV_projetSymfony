<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328074003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B388987678');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP INDEX UNIQ_1D1C63B388987678 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD uti_role VARCHAR(38) NOT NULL, DROP role_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, rol_libelle VARCHAR(38) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE entreprise CHANGE ent_rs ent_rs VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_ville ent_ville VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_adresse ent_adresse VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_pays ent_pays VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE fonction CHANGE fon_libelle fon_libelle VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `option` CHANGE opt_libelle opt_libelle VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE personne CHANGE per_nom per_nom VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE per_prenom per_prenom VARCHAR(38) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE per_mail per_mail VARCHAR(50) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE profil CHANGE pro_libelle pro_libelle VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE utilisateur ADD role_id_id INT NOT NULL, DROP uti_role, CHANGE uti_username uti_username VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE uti_mdp uti_mdp VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B388987678 FOREIGN KEY (role_id_id) REFERENCES role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B388987678 ON utilisateur (role_id_id)');
    }
}
