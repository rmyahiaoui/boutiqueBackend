<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200613095150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE couleur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chaussure (id INT AUTO_INCREMENT NOT NULL, couleur_id INT DEFAULT NULL, marque VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, matière VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, date_vente DATETIME NOT NULL, INDEX IDX_43D47897C31BA576 (couleur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chaussure ADD CONSTRAINT FK_43D47897C31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chaussure DROP FOREIGN KEY FK_43D47897C31BA576');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP TABLE chaussure');
    }
}
