<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190816085326 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contractor_creditors (id CHAR(36) NOT NULL COMMENT \'(DC2Type:contractor_creditor_id)\', name VARCHAR(60) NOT NULL, number VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_F5D5F8485E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contractor_contractors (id CHAR(36) NOT NULL COMMENT \'(DC2Type:contractor_contractor_id)\', creditor_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:contractor_creditor_id)\', name_one VARCHAR(60) NOT NULL, name_two VARCHAR(60) DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, INDEX IDX_F1C17580DF91AC92 (creditor_id), UNIQUE INDEX UNIQ_F1C175807E798E1F15DF8288 (name_one, name_two), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contractor_contractors ADD CONSTRAINT FK_F1C17580DF91AC92 FOREIGN KEY (creditor_id) REFERENCES contractor_creditors (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contractor_contractors DROP FOREIGN KEY FK_F1C17580DF91AC92');
        $this->addSql('DROP TABLE contractor_creditors');
        $this->addSql('DROP TABLE contractor_contractors');
    }
}
