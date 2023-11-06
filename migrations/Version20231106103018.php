<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231106103018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE agency_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE flat_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agency (id INT NOT NULL, name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70C0C6E65E237E06 ON agency (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70C0C6E66B01BC5B ON agency (phone_number)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70C0C6E6E7927C74 ON agency (email)');
        $this->addSql('CREATE TABLE flat_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE post (id INT NOT NULL, post_owner_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, content TEXT NOT NULL, timestamps TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D639D215F ON post (post_owner_id_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, user_type_id_id INT DEFAULT NULL, party_id_id INT DEFAULT NULL, agency_admin_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, middle_name VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, timestamps TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6496B01BC5B ON "user" (phone_number)');
        $this->addSql('CREATE INDEX IDX_8D93D649D62FDF4C ON "user" (user_type_id_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496081BEF8 ON "user" (party_id_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E77B5A1C ON "user" (agency_admin_id_id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D639D215F FOREIGN KEY (post_owner_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649D62FDF4C FOREIGN KEY (user_type_id_id) REFERENCES user_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6496081BEF8 FOREIGN KEY (party_id_id) REFERENCES party (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649E77B5A1C FOREIGN KEY (agency_admin_id_id) REFERENCES agency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flat ADD flat_type_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE flat ADD CONSTRAINT FK_554AAA449C926D96 FOREIGN KEY (flat_type_id_id) REFERENCES flat_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_554AAA449C926D96 ON flat (flat_type_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE flat DROP CONSTRAINT FK_554AAA449C926D96');
        $this->addSql('DROP SEQUENCE agency_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE flat_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE post_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D639D215F');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649D62FDF4C');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6496081BEF8');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649E77B5A1C');
        $this->addSql('DROP TABLE agency');
        $this->addSql('DROP TABLE flat_type');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP INDEX IDX_554AAA449C926D96');
        $this->addSql('ALTER TABLE flat DROP flat_type_id_id');
    }
}
