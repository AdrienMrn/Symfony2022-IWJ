<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220520123704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_773DE69DB03A8386 ON car (created_by_id)');
        $this->addSql('CREATE INDEX IDX_773DE69D896DBBDE ON car (updated_by_id)');
        $this->addSql('ALTER TABLE customer ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE customer ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP CONSTRAINT FK_773DE69DB03A8386');
        $this->addSql('ALTER TABLE car DROP CONSTRAINT FK_773DE69D896DBBDE');
        $this->addSql('DROP INDEX IDX_773DE69DB03A8386');
        $this->addSql('DROP INDEX IDX_773DE69D896DBBDE');
        $this->addSql('ALTER TABLE car DROP created_by_id');
        $this->addSql('ALTER TABLE car DROP updated_by_id');
        $this->addSql('ALTER TABLE customer DROP created_at');
        $this->addSql('ALTER TABLE customer DROP updated_at');
    }
}
