<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220520141918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE brand ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE brand ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE brand ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE brand ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE brand ADD CONSTRAINT FK_1C52F958B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE brand ADD CONSTRAINT FK_1C52F958896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1C52F958B03A8386 ON brand (created_by_id)');
        $this->addSql('CREATE INDEX IDX_1C52F958896DBBDE ON brand (updated_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE brand DROP CONSTRAINT FK_1C52F958B03A8386');
        $this->addSql('ALTER TABLE brand DROP CONSTRAINT FK_1C52F958896DBBDE');
        $this->addSql('DROP INDEX IDX_1C52F958B03A8386');
        $this->addSql('DROP INDEX IDX_1C52F958896DBBDE');
        $this->addSql('ALTER TABLE brand DROP created_by_id');
        $this->addSql('ALTER TABLE brand DROP updated_by_id');
        $this->addSql('ALTER TABLE brand DROP created_at');
        $this->addSql('ALTER TABLE brand DROP updated_at');
    }
}
