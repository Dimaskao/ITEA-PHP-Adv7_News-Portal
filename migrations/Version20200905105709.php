<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200905105709 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<SQL
            CREATE TABLE article (
                id INT AUTO_INCREMENT NOT NULL, 
                title VARCHAR(255) NOT NULL, 
                image VARCHAR(100) DEFAULT NULL, 
                short_description VARCHAR(500) DEFAULT NULL, 
                body LONGTEXT DEFAULT NULL, 
                publication_date DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', 
                created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', 
                updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', 
                PRIMARY KEY(id)
                ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article');
    }
}
