<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303121910 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD formations_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA73BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA73BF5B0C2 ON event (formations_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA73BF5B0C2');
        $this->addSql('DROP INDEX IDX_3BAE0AA73BF5B0C2 ON event');
        $this->addSql('ALTER TABLE event DROP formations_id');
    }
}
