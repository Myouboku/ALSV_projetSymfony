<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315142914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annee CHANGE annee_libelle annee_libelle INT NOT NULL');
        $this->addSql('ALTER TABLE fonction CHANGE fon_libelle fon_libelle VARCHAR(38) NOT NULL');
        $this->addSql('ALTER TABLE personne CHANGE per_tel per_tel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profil CHANGE pro_libelle pro_libelle VARCHAR(38) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annee CHANGE annee_libelle annee_libelle INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise CHANGE ent_rs ent_rs VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_ville ent_ville VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_adresse ent_adresse VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_pays ent_pays VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE fonction CHANGE fon_libelle fon_libelle VARCHAR(38) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `option` CHANGE opt_libelle opt_libelle VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE personne CHANGE per_nom per_nom VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE per_prenom per_prenom VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE per_mail per_mail VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE per_tel per_tel INT NOT NULL');
        $this->addSql('ALTER TABLE profil CHANGE pro_libelle pro_libelle VARCHAR(38) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE role CHANGE rol_libelle rol_libelle VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE utilisateur CHANGE uti_mdp uti_mdp VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE uti_username uti_username VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
