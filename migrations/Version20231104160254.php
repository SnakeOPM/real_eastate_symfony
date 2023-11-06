<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231104160254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE flat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE party_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE flat (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, address TEXT NOT NULL, rooms_count INT NOT NULL, square INT DEFAULT NULL, price INT NOT NULL, pets BOOLEAN DEFAULT NULL, timestamps TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE party (id INT NOT NULL, name VARCHAR(255) NOT NULL, invite_token VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE party_flat (party_id INT NOT NULL, flat_id INT NOT NULL, PRIMARY KEY(party_id, flat_id))');
        $this->addSql('CREATE INDEX IDX_4AE96B97213C1059 ON party_flat (party_id)');
        $this->addSql('CREATE INDEX IDX_4AE96B97D3331C94 ON party_flat (flat_id)');
        $this->addSql('ALTER TABLE party_flat ADD CONSTRAINT FK_4AE96B97213C1059 FOREIGN KEY (party_id) REFERENCES party (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE party_flat ADD CONSTRAINT FK_4AE96B97D3331C94 FOREIGN KEY (flat_id) REFERENCES flat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE flat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE party_id_seq CASCADE');
        $this->addSql('ALTER TABLE party_flat DROP CONSTRAINT FK_4AE96B97213C1059');
        $this->addSql('ALTER TABLE party_flat DROP CONSTRAINT FK_4AE96B97D3331C94');
        $this->addSql('DROP TABLE flat');
        $this->addSql('DROP TABLE party');
        $this->addSql('DROP TABLE party_flat');
    }
}
