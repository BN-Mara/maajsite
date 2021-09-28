<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629202956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate ADD cover_image_id INT DEFAULT NULL, ADD abstract LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44E5A0E336 FOREIGN KEY (cover_image_id) REFERENCES media__media (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C8B28E44E5A0E336 ON candidate (cover_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44E5A0E336');
        $this->addSql('DROP INDEX UNIQ_C8B28E44E5A0E336 ON candidate');
        $this->addSql('ALTER TABLE candidate DROP cover_image_id, DROP abstract');
    }
}
