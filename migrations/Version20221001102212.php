<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221001102212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_group CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE admin_group ADD CONSTRAINT FK_CDEABF3FBF396750 FOREIGN KEY (id) REFERENCES gestionnaires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gestionnaires ADD type VARCHAR(255) NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE person ADD avatar LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE super_admin CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE super_admin ADD CONSTRAINT FK_BC8C2783BF396750 FOREIGN KEY (id) REFERENCES gestionnaires (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_group DROP FOREIGN KEY FK_CDEABF3FBF396750');
        $this->addSql('ALTER TABLE admin_group CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE gestionnaires DROP type, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE person DROP avatar');
        $this->addSql('ALTER TABLE super_admin DROP FOREIGN KEY FK_BC8C2783BF396750');
        $this->addSql('ALTER TABLE super_admin CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
