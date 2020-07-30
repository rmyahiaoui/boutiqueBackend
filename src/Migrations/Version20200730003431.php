<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200730003431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hash_site ADD site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hash_site ADD CONSTRAINT FK_D6905E54F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D6905E54F6BD1646 ON hash_site (site_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hash_site DROP FOREIGN KEY FK_D6905E54F6BD1646');
        $this->addSql('DROP INDEX UNIQ_D6905E54F6BD1646 ON hash_site');
        $this->addSql('ALTER TABLE hash_site DROP site_id');
    }
}
