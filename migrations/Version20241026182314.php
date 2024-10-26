<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241026182314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking_appartment (booking_id INT NOT NULL, appartment_id INT NOT NULL, INDEX IDX_54F94E813301C60 (booking_id), INDEX IDX_54F94E812714DC20 (appartment_id), PRIMARY KEY(booking_id, appartment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review_booking (review_id INT NOT NULL, booking_id INT NOT NULL, INDEX IDX_7BE259293E2E969B (review_id), INDEX IDX_7BE259293301C60 (booking_id), PRIMARY KEY(review_id, booking_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_appartment ADD CONSTRAINT FK_54F94E813301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_appartment ADD CONSTRAINT FK_54F94E812714DC20 FOREIGN KEY (appartment_id) REFERENCES appartment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review_booking ADD CONSTRAINT FK_7BE259293E2E969B FOREIGN KEY (review_id) REFERENCES review (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review_booking ADD CONSTRAINT FK_7BE259293301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking ADD tenant_id INT NOT NULL, ADD payment_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE9033212A ON booking (tenant_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E00CEDDE4C3A3BB ON booking (payment_id)');
        $this->addSql('ALTER TABLE review ADD tenant_id INT NOT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C69033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id)');
        $this->addSql('CREATE INDEX IDX_794381C69033212A ON review (tenant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking_appartment DROP FOREIGN KEY FK_54F94E813301C60');
        $this->addSql('ALTER TABLE booking_appartment DROP FOREIGN KEY FK_54F94E812714DC20');
        $this->addSql('ALTER TABLE review_booking DROP FOREIGN KEY FK_7BE259293E2E969B');
        $this->addSql('ALTER TABLE review_booking DROP FOREIGN KEY FK_7BE259293301C60');
        $this->addSql('DROP TABLE booking_appartment');
        $this->addSql('DROP TABLE review_booking');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9033212A');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE4C3A3BB');
        $this->addSql('DROP INDEX IDX_E00CEDDE9033212A ON booking');
        $this->addSql('DROP INDEX UNIQ_E00CEDDE4C3A3BB ON booking');
        $this->addSql('ALTER TABLE booking DROP tenant_id, DROP payment_id');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C69033212A');
        $this->addSql('DROP INDEX IDX_794381C69033212A ON review');
        $this->addSql('ALTER TABLE review DROP tenant_id');
    }
}
