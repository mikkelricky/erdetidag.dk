<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210221163206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "";
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            "CREATE TABLE settings (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, monday VARCHAR(255) NOT NULL, tuesday VARCHAR(255) NOT NULL, wednesday VARCHAR(255) NOT NULL, thursday VARCHAR(255) NOT NULL, friday VARCHAR(255) NOT NULL, saturday VARCHAR(255) NOT NULL, sunday VARCHAR(255) NOT NULL)"
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DROP TABLE settings");
    }
}
