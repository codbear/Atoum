<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201122205052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection ADD publisher_id INT NOT NULL');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D653240C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id)');
        $this->addSql('CREATE INDEX IDX_FC4D653240C86FCE ON collection (publisher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D653240C86FCE');
        $this->addSql('DROP INDEX IDX_FC4D653240C86FCE ON collection');
        $this->addSql('ALTER TABLE collection DROP publisher_id');
    }
}
