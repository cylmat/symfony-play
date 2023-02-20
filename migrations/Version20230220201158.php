<?php

declare(strict_types=1);

namespace AppBundleMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230220201158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__log AS SELECT id, level, channel, message FROM log');
        $this->addSql('DROP TABLE log');
        $this->addSql('CREATE TABLE log (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, level VARCHAR(255) NOT NULL, channel VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO log (id, level, channel, message) SELECT id, level, channel, message FROM __temp__log');
        $this->addSql('DROP TABLE __temp__log');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__Log AS SELECT id, level, channel, message FROM Log');
        $this->addSql('DROP TABLE Log');
        $this->addSql('CREATE TABLE Log (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, level INTEGER NOT NULL, channel VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO Log (id, level, channel, message) SELECT id, level, channel, message FROM __temp__Log');
        $this->addSql('DROP TABLE __temp__Log');
    }
}
