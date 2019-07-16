<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716192522 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE article ALTER tile TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE article ALTER body DROP NOT NULL');
        $this->addSql('ALTER TABLE article ALTER date_created TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE article ALTER date_created DROP DEFAULT');
        $this->addSql('ALTER TABLE article ALTER author TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE article ALTER short_description TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE article ALTER categorie_id DROP NOT NULL');
        $this->addSql('ALTER TABLE article ALTER url TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_23A0E66BCF5E72D ON article (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categories_id_seq CASCADE');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66BCF5E72D');
        $this->addSql('DROP INDEX IDX_23A0E66BCF5E72D');
        $this->addSql('ALTER TABLE article ALTER categorie_id SET NOT NULL');
        $this->addSql('ALTER TABLE article ALTER tile TYPE CHAR(255)');
        $this->addSql('ALTER TABLE article ALTER body SET NOT NULL');
        $this->addSql('ALTER TABLE article ALTER date_created TYPE DATE');
        $this->addSql('ALTER TABLE article ALTER date_created DROP DEFAULT');
        $this->addSql('ALTER TABLE article ALTER author TYPE CHAR(255)');
        $this->addSql('ALTER TABLE article ALTER url TYPE CHAR(255)');
        $this->addSql('ALTER TABLE article ALTER short_description TYPE CHAR(255)');
    }
}
