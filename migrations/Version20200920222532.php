<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200920222532 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement ADD date_end_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E609B5F3 FOREIGN KEY (date_end_id) REFERENCES date (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B26681E609B5F3 ON evenement (date_end_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E609B5F3');
        $this->addSql('DROP INDEX UNIQ_B26681E609B5F3 ON evenement');
        $this->addSql('ALTER TABLE evenement DROP date_end_id');
    }
}
