<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240806125510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create user table and insert initial data';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT PRIMARY KEY, data VARCHAR(255))');
        $this->addSql("INSERT INTO user (data) VALUES ('Barack - Obama - White House')");
        $this->addSql("INSERT INTO user (data) VALUES ('Britney - Spears - America')");
        $this->addSql("INSERT INTO user (data) VALUES ('Leonardo - DiCaprio - Titanic')");

        $this->addSql("INSERT INTO user (data) VALUES ('Barack - Obama - White House')");
        $this->addSql("INSERT INTO user (data) VALUES ('Britney - Spears - America')");
        $this->addSql("INSERT INTO user (data) VALUES ('Leonardo - DiCaprio - Titanic')");

        $this->addSql("INSERT INTO user (data) VALUES ('Barack - Obama - White House')");
        $this->addSql("INSERT INTO user (data) VALUES ('Britney - Spears - America')");
        $this->addSql("INSERT INTO user (data) VALUES ('Leonardo - DiCaprio - Titanic')");

        $this->addSql("INSERT INTO user (data) VALUES ('Barack - Obama - White House')");
        $this->addSql("INSERT INTO user (data) VALUES ('Britney - Spears - America')");
        $this->addSql("INSERT INTO user (data) VALUES ('Leonardo - DiCaprio - Titanic')");

        $this->addSql("INSERT INTO user (data) VALUES ('Barack - Obama - White House')");
        $this->addSql("INSERT INTO user (data) VALUES ('Britney - Spears - America')");
        $this->addSql("INSERT INTO user (data) VALUES ('Leonardo - DiCaprio - Titanic')");

        $this->addSql("INSERT INTO user (data) VALUES ('Barack - Obama - White House')");
        $this->addSql("INSERT INTO user (data) VALUES ('Britney - Spears - America')");
        $this->addSql("INSERT INTO user (data) VALUES ('Leonardo - DiCaprio - Titanic')");

        $this->addSql("INSERT INTO user (data) VALUES ('Barack - Obama - White House')");
        $this->addSql("INSERT INTO user (data) VALUES ('Britney - Spears - America')");
        $this->addSql("INSERT INTO user (data) VALUES ('Leonardo - DiCaprio - Titanic')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
    }
}
