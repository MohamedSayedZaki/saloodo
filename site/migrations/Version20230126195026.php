<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126195026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE biker (
            id INT AUTO_INCREMENT NOT NULL, 
            user_id INT DEFAULT NULL, 
            mobile VARCHAR(30) DEFAULT NULL, 
            created_at DATETIME NOT NULL, 
            updated_at DATETIME NOT NULL, 
            UNIQUE INDEX UNIQ_81FDC08AA76ED395 (user_id), PRIMARY KEY(id)) 
            DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql('CREATE TABLE sender (
            id INT AUTO_INCREMENT NOT NULL, 
            user_id INT DEFAULT NULL, 
            mobile VARCHAR(30) DEFAULT NULL, 
            created_at DATETIME NOT NULL, 
            updated_at DATETIME NOT NULL, 
            UNIQUE INDEX UNIQ_5F004ACFA76ED395 (user_id), 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql('CREATE TABLE user (
            id INT AUTO_INCREMENT NOT NULL, 
            username VARCHAR(255) NOT NULL, 
            email VARCHAR(255) NOT NULL, 
            password VARCHAR(255) NOT NULL, 
            roles JSON NOT NULL, 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE biker ADD CONSTRAINT FK_81FDC08AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sender ADD CONSTRAINT FK_5F004ACFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biker DROP FOREIGN KEY FK_81FDC08AA76ED395');
        $this->addSql('ALTER TABLE sender DROP FOREIGN KEY FK_5F004ACFA76ED395');
        $this->addSql('DROP TABLE biker');
        $this->addSql('DROP TABLE sender');
        $this->addSql('DROP TABLE user');
    }
}
