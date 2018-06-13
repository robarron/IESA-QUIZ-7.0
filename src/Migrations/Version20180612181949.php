<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180612181949 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quiz ADD prop_1 VARCHAR(255) DEFAULT NULL, ADD prop_2 VARCHAR(255) DEFAULT NULL, ADD prop_3 VARCHAR(255) DEFAULT NULL, ADD prop_4 VARCHAR(255) DEFAULT NULL, DROP prop1, DROP prop2, DROP prop3, DROP prop4');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quiz ADD prop1 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD prop2 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD prop3 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD prop4 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP prop_1, DROP prop_2, DROP prop_3, DROP prop_4');
    }
}
