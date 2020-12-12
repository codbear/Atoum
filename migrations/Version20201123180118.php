<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123180118 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publisher ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE publisher ADD CONSTRAINT FK_9CE8D5467E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9CE8D5467E3C61F9 ON publisher (owner_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publisher DROP FOREIGN KEY FK_9CE8D5467E3C61F9');
        $this->addSql('DROP INDEX IDX_9CE8D5467E3C61F9 ON publisher');
        $this->addSql('ALTER TABLE publisher DROP owner_id');
    }
}
