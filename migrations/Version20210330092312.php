<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330092312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD iduser_id INT NOT NULL, ADD idevent_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955786A81FB FOREIGN KEY (iduser_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955DB22A086 FOREIGN KEY (idevent_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_42C84955786A81FB ON reservation (iduser_id)');
        $this->addSql('CREATE INDEX IDX_42C84955DB22A086 ON reservation (idevent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955786A81FB');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955DB22A086');
        $this->addSql('DROP INDEX IDX_42C84955786A81FB ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955DB22A086 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP iduser_id, DROP idevent_id');
    }
}
