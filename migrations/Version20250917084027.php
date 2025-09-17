<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250917084027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tbl_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player_category DROP FOREIGN KEY FK_9B582112469DE2');
        $this->addSql('ALTER TABLE player_category ADD CONSTRAINT FK_9B582112469DE2 FOREIGN KEY (category_id) REFERENCES tbl_category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_category DROP FOREIGN KEY FK_9B582112469DE2');
        $this->addSql('DROP TABLE tbl_category');
        $this->addSql('ALTER TABLE player_category DROP FOREIGN KEY FK_9B582112469DE2');
        $this->addSql('ALTER TABLE player_category ADD CONSTRAINT FK_9B582112469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }
}
