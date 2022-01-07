<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220107101917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create the Projet and Category entities, to prepare projects to post.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_project (category_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_E86B909012469DE2 (category_id), INDEX IDX_E86B9090166D1F9C (project_id), PRIMARY KEY(category_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, preview VARCHAR(255) DEFAULT NULL, creation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_project ADD CONSTRAINT FK_E86B909012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_project ADD CONSTRAINT FK_E86B9090166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_project DROP FOREIGN KEY FK_E86B909012469DE2');
        $this->addSql('ALTER TABLE category_project DROP FOREIGN KEY FK_E86B9090166D1F9C');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_project');
        $this->addSql('DROP TABLE project');
    }
}
