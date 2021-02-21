<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210221204057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "";
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            "CREATE TABLE site (host VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, messages_monday VARCHAR(255) NOT NULL, messages_tuesday VARCHAR(255) NOT NULL, messages_wednesday VARCHAR(255) NOT NULL, messages_thursday VARCHAR(255) NOT NULL, messages_friday VARCHAR(255) NOT NULL, messages_saturday VARCHAR(255) NOT NULL, messages_sunday VARCHAR(255) NOT NULL, PRIMARY KEY(host))"
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DROP TABLE site");
    }
}
