<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200709125717 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit ADD auteur_id INT NOT NULL, ADD ref_bd VARCHAR(8) NOT NULL, ADD heros VARCHAR(50) DEFAULT NULL, ADD titre VARCHAR(50) NOT NULL, ADD prix_public NUMERIC(8, 2) NOT NULL, ADD prix_editeur NUMERIC(8, 2) NOT NULL, ADD resume LONGTEXT DEFAULT NULL, ADD ref_fournisseur BIGINT DEFAULT NULL, ADD ref_editeur BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2760BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2760BB6FE6 ON produit (auteur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2760BB6FE6');
        $this->addSql('DROP INDEX IDX_29A5EC2760BB6FE6 ON produit');
        $this->addSql('ALTER TABLE produit DROP auteur_id, DROP ref_bd, DROP heros, DROP titre, DROP prix_public, DROP prix_editeur, DROP resume, DROP ref_fournisseur, DROP ref_editeur');
    }
}
