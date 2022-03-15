<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315095042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personne_fonction (personne_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_CAD2D4F8A21BD112 (personne_id), INDEX IDX_CAD2D4F857889920 (fonction_id), PRIMARY KEY(personne_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personne_fonction ADD CONSTRAINT FK_CAD2D4F8A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_fonction ADD CONSTRAINT FK_CAD2D4F857889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE personne_fonction');
        $this->addSql('ALTER TABLE entreprise CHANGE ent_rs ent_rs VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_ville ent_ville VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_adresse ent_adresse VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_pays ent_pays VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE fonction CHANGE fon_libelle fon_libelle VARCHAR(38) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `option` CHANGE opt_libelle opt_libelle VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE personne CHANGE per_nom per_nom VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE per_prenom per_prenom VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE per_mail per_mail VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE profil CHANGE pro_libelle pro_libelle VARCHAR(38) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE role CHANGE rol_libelle rol_libelle VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE utilisateur CHANGE uti_mdp uti_mdp VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE uti_username uti_username VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
