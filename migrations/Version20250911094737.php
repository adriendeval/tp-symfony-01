<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250911094737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `tbl_groups` (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_levels (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_players (id INT AUTO_INCREMENT NOT NULL, level_id INT NOT NULL, name VARCHAR(100) NOT NULL, xp INT DEFAULT NULL, INDEX IDX_7D1D4BD25FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_group (player_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_D2B23F8399E6F5DF (player_id), INDEX IDX_D2B23F83FE54D947 (group_id), PRIMARY KEY(player_id, group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbl_players ADD CONSTRAINT FK_7D1D4BD25FB14BA7 FOREIGN KEY (level_id) REFERENCES tbl_levels (id)');
        $this->addSql('ALTER TABLE player_group ADD CONSTRAINT FK_D2B23F8399E6F5DF FOREIGN KEY (player_id) REFERENCES tbl_players (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_group ADD CONSTRAINT FK_D2B23F83FE54D947 FOREIGN KEY (group_id) REFERENCES `tbl_groups` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tbl_players DROP FOREIGN KEY FK_7D1D4BD25FB14BA7');
        $this->addSql('ALTER TABLE player_group DROP FOREIGN KEY FK_D2B23F8399E6F5DF');
        $this->addSql('ALTER TABLE player_group DROP FOREIGN KEY FK_D2B23F83FE54D947');
        $this->addSql('DROP TABLE `tbl_groups`');
        $this->addSql('DROP TABLE tbl_levels');
        $this->addSql('DROP TABLE tbl_players');
        $this->addSql('DROP TABLE player_group');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
