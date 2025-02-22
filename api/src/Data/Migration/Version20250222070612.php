<?php

declare(strict_types=1);

namespace App\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250222070612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add OAuth';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE oauth_auth_codes (identifier VARCHAR(80) NOT NULL, expiry_date_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, user_identifier UUID NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('COMMENT ON COLUMN oauth_auth_codes.expiry_date_time IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE oauth_refresh_tokens (identifier VARCHAR(80) NOT NULL, expiry_date_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, user_identifier UUID NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('COMMENT ON COLUMN oauth_refresh_tokens.expiry_date_time IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE oauth_auth_codes');
        $this->addSql('DROP TABLE oauth_refresh_tokens');
    }
}
