<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212092726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D65327E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FC4D65327E3C61F9 ON collection (owner_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D65327E3C61F9');
        $this->addSql('DROP INDEX IDX_FC4D65327E3C61F9 ON collection');
        $this->addSql('ALTER TABLE collection DROP owner_id');
    }
}
