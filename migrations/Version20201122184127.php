<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201122184127 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BDAFD8C85E237E06 ON author (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CD982E555E237E06 ON binding_format (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_835033F85E237E06 ON genre (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9CE8D5465E237E06 ON publisher (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_BDAFD8C85E237E06 ON author');
        $this->addSql('DROP INDEX UNIQ_CD982E555E237E06 ON binding_format');
        $this->addSql('DROP INDEX UNIQ_835033F85E237E06 ON genre');
        $this->addSql('DROP INDEX UNIQ_9CE8D5465E237E06 ON publisher');
    }
}
