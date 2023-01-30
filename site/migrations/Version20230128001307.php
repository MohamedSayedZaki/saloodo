<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230128001307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE biker_parcel (
            id INT AUTO_INCREMENT NOT NULL, 
            parcel_id INT NOT NULL, 
            biker_id INT NOT NULL, 
            pick_up_at DATETIME NOT NULL, 
            drop_off_at DATETIME NOT NULL, 
            status VARCHAR(255) NOT NULL, 
            INDEX IDX_E8675459465E670C (parcel_id), 
            INDEX IDX_E867545982150208 (biker_id), 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
            
        $this->addSql('ALTER TABLE biker_parcel ADD CONSTRAINT FK_E8675459465E670C FOREIGN KEY (parcel_id) REFERENCES parcel (id)');
        $this->addSql('ALTER TABLE biker_parcel ADD CONSTRAINT FK_E867545982150208 FOREIGN KEY (biker_id) REFERENCES biker (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biker_parcel DROP FOREIGN KEY FK_E8675459465E670C');
        $this->addSql('ALTER TABLE biker_parcel DROP FOREIGN KEY FK_E867545982150208');
        $this->addSql('DROP TABLE biker_parcel');
    }
}
