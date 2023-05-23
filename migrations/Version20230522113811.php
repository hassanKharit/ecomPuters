<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522113811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, factures_id INT NOT NULL, produit_id INT NOT NULL, quantite NUMERIC(10, 2) NOT NULL, INDEX IDX_35D4282CE9D518F9 (factures_id), INDEX IDX_35D4282CF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, datecrea DATETIME NOT NULL, INDEX IDX_FE86641067B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CE9D518F9 FOREIGN KEY (factures_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CF347EFB FOREIGN KEY (produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641067B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CE9D518F9');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CF347EFB');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641067B3B43D');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE facture');
    }
}
