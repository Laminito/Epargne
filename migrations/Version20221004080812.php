<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004080812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_group (id INT NOT NULL, super_admin_id INT DEFAULT NULL, INDEX IDX_CDEABF3FBBF91D3B (super_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestionnaires (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2094A9D8E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT NOT NULL, admin_group_id INT DEFAULT NULL, matricule INT DEFAULT NULL, INDEX IDX_70E4FA786AF4DE41 (admin_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(100) DEFAULT NULL, nom VARCHAR(50) DEFAULT NULL, telephone VARCHAR(100) DEFAULT NULL, adresse VARCHAR(100) DEFAULT NULL, cni INT DEFAULT NULL, sexe VARCHAR(50) DEFAULT NULL, avatar LONGBLOB DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE super_admin (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_group ADD CONSTRAINT FK_CDEABF3FBBF91D3B FOREIGN KEY (super_admin_id) REFERENCES super_admin (id)');
        $this->addSql('ALTER TABLE admin_group ADD CONSTRAINT FK_CDEABF3FBF396750 FOREIGN KEY (id) REFERENCES gestionnaires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA786AF4DE41 FOREIGN KEY (admin_group_id) REFERENCES admin_group (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78BF396750 FOREIGN KEY (id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE super_admin ADD CONSTRAINT FK_BC8C2783BF396750 FOREIGN KEY (id) REFERENCES gestionnaires (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_group DROP FOREIGN KEY FK_CDEABF3FBBF91D3B');
        $this->addSql('ALTER TABLE admin_group DROP FOREIGN KEY FK_CDEABF3FBF396750');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA786AF4DE41');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78BF396750');
        $this->addSql('ALTER TABLE super_admin DROP FOREIGN KEY FK_BC8C2783BF396750');
        $this->addSql('DROP TABLE admin_group');
        $this->addSql('DROP TABLE gestionnaires');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE super_admin');
    }
}
