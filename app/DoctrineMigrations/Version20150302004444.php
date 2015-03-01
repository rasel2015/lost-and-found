<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150302004444 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_log_actions CHANGE action action_type ENUM(\'connect\', \'login\', \'deauthorize\') NOT NULL COMMENT \'(DC2Type:UserActionType)\'');
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94DD3564642');
        $this->addSql('DROP INDEX IDX_E11EE94DDE12AB56 ON items');
        $this->addSql('ALTER TABLE items CHANGE created_by created_by_id INT NOT NULL, CHANGE areatype area_type ENUM(\'polygon\', \'rectangle\', \'circle\', \'marker\') NOT NULL COMMENT \'(DC2Type:ItemAreaTypeType)\'');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_E11EE94DB03A8386 ON items (created_by_id)');
        $this->addSql('CREATE INDEX search_idx ON items (latitude, longitude)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94DB03A8386');
        $this->addSql('DROP INDEX IDX_E11EE94DB03A8386 ON items');
        $this->addSql('DROP INDEX search_idx ON items');
        $this->addSql('ALTER TABLE items CHANGE created_by_id created_by INT NOT NULL, CHANGE area_type areaType ENUM(\'polygon\', \'rectangle\', \'circle\', \'marker\') NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:ItemAreaTypeType)\'');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DD3564642 FOREIGN KEY (created_by) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_E11EE94DDE12AB56 ON items (created_by)');
        $this->addSql('ALTER TABLE user_log_actions CHANGE action_type action ENUM(\'connect\', \'login\', \'deauthorize\') NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:UserActionType)\'');
    }
}
