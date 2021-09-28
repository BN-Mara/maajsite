<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210701122719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vote_jury (id INT AUTO_INCREMENT NOT NULL, candidate_id INT DEFAULT NULL, jury_id INT DEFAULT NULL, prestation VARCHAR(10) DEFAULT NULL, senique INT NOT NULL, prestance INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, evaluation_total INT DEFAULT NULL, INDEX IDX_A457411D91BD8781 (candidate_id), INDEX IDX_A457411DE560103C (jury_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vote_jury ADD CONSTRAINT FK_A457411D91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE vote_jury ADD CONSTRAINT FK_A457411DE560103C FOREIGN KEY (jury_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vote_jury');
    }
}
