<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200802152649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE date (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employer (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, post VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_DE4CF066A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, date_id INT NOT NULL, adresse VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B26681EB897366B (date_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_services (evenement_id INT NOT NULL, services_id INT NOT NULL, INDEX IDX_FC547A81FD02F13 (evenement_id), INDEX IDX_FC547A81AEF5A6C1 (services_id), PRIMARY KEY(evenement_id, services_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, services_id INT DEFAULT NULL, evenement_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_6A2CA10CAEF5A6C1 (services_id), INDEX IDX_6A2CA10CFD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, date_id INT NOT NULL, client_id INT NOT NULL, UNIQUE INDEX UNIQ_42C84955B897366B (date_id), INDEX IDX_42C8495519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, decription VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, disponibilite TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, created_at_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tele INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D6495F0218B (created_at_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE employer ADD CONSTRAINT FK_DE4CF066A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EB897366B FOREIGN KEY (date_id) REFERENCES date (id)');
        $this->addSql('ALTER TABLE evenement_services ADD CONSTRAINT FK_FC547A81FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_services ADD CONSTRAINT FK_FC547A81AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CAEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B897366B FOREIGN KEY (date_id) REFERENCES date (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495F0218B FOREIGN KEY (created_at_id) REFERENCES date (id)');
        $this->addSql('DROP TABLE wp_commentmeta');
        $this->addSql('DROP TABLE wp_comments');
        $this->addSql('DROP TABLE wp_links');
        $this->addSql('DROP TABLE wp_options');
        $this->addSql('DROP TABLE wp_postmeta');
        $this->addSql('DROP TABLE wp_posts');
        $this->addSql('DROP TABLE wp_term_relationships');
        $this->addSql('DROP TABLE wp_term_taxonomy');
        $this->addSql('DROP TABLE wp_termmeta');
        $this->addSql('DROP TABLE wp_terms');
        $this->addSql('DROP TABLE wp_usermeta');
        $this->addSql('DROP TABLE wp_users');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495519EB6921');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EB897366B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B897366B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495F0218B');
        $this->addSql('ALTER TABLE evenement_services DROP FOREIGN KEY FK_FC547A81FD02F13');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CFD02F13');
        $this->addSql('ALTER TABLE evenement_services DROP FOREIGN KEY FK_FC547A81AEF5A6C1');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CAEF5A6C1');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('ALTER TABLE employer DROP FOREIGN KEY FK_DE4CF066A76ED395');
        $this->addSql('CREATE TABLE wp_commentmeta (meta_id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, comment_id BIGINT UNSIGNED DEFAULT 0 NOT NULL, meta_key VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, meta_value LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX comment_id (comment_id), INDEX meta_key (meta_key(191)), PRIMARY KEY(meta_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wp_comments (comment_ID BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, comment_post_ID BIGINT UNSIGNED DEFAULT 0 NOT NULL, comment_author TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, comment_author_email VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, comment_author_url VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, comment_author_IP VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, comment_date DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, comment_date_gmt DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, comment_content TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, comment_karma INT DEFAULT 0 NOT NULL, comment_approved VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'1\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, comment_agent VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, comment_type VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, comment_parent BIGINT UNSIGNED DEFAULT 0 NOT NULL, user_id BIGINT UNSIGNED DEFAULT 0 NOT NULL, INDEX comment_author_email (comment_author_email(10)), INDEX comment_post_ID (comment_post_ID), INDEX comment_date_gmt (comment_date_gmt), INDEX comment_approved_date_gmt (comment_approved, comment_date_gmt), INDEX comment_parent (comment_parent), PRIMARY KEY(comment_ID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wp_links (link_id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, link_url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, link_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, link_image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, link_target VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, link_description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, link_visible VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'Y\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, link_owner BIGINT UNSIGNED DEFAULT 1 NOT NULL, link_rating INT DEFAULT 0 NOT NULL, link_updated DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, link_rel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, link_notes MEDIUMTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, link_rss VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX link_visible (link_visible), PRIMARY KEY(link_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wp_options (option_id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, option_name VARCHAR(191) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, option_value LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, autoload VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'yes\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX option_name (option_name), INDEX autoload (autoload), PRIMARY KEY(option_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wp_postmeta (meta_id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, post_id BIGINT UNSIGNED DEFAULT 0 NOT NULL, meta_key VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, meta_value LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX post_id (post_id), INDEX meta_key (meta_key(191)), PRIMARY KEY(meta_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wp_posts (ID BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, post_author BIGINT UNSIGNED DEFAULT 0 NOT NULL, post_date DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, post_date_gmt DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, post_content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, post_title TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, post_excerpt TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, post_status VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'publish\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, comment_status VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'open\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, ping_status VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'open\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, post_password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, post_name VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, to_ping TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pinged TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, post_modified DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, post_modified_gmt DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, post_content_filtered LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, post_parent BIGINT UNSIGNED DEFAULT 0 NOT NULL, guid VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, menu_order INT DEFAULT 0 NOT NULL, post_type VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'post\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, post_mime_type VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, comment_count BIGINT DEFAULT 0 NOT NULL, INDEX post_parent (post_parent), INDEX post_name (post_name(191)), INDEX post_author (post_author), INDEX type_status_date (post_type, post_status, post_date, ID), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wp_term_relationships (object_id BIGINT UNSIGNED DEFAULT 0 NOT NULL, term_taxonomy_id BIGINT UNSIGNED DEFAULT 0 NOT NULL, term_order INT DEFAULT 0 NOT NULL, INDEX term_taxonomy_id (term_taxonomy_id), PRIMARY KEY(object_id, term_taxonomy_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wp_term_taxonomy (term_taxonomy_id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, term_id BIGINT UNSIGNED DEFAULT 0 NOT NULL, taxonomy VARCHAR(32) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, parent BIGINT UNSIGNED DEFAULT 0 NOT NULL, count BIGINT DEFAULT 0 NOT NULL, INDEX taxonomy (taxonomy), UNIQUE INDEX term_id_taxonomy (term_id, taxonomy), PRIMARY KEY(term_taxonomy_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wp_termmeta (meta_id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, term_id BIGINT UNSIGNED DEFAULT 0 NOT NULL, meta_key VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, meta_value LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX term_id (term_id), INDEX meta_key (meta_key(191)), PRIMARY KEY(meta_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wp_terms (term_id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, term_group BIGINT DEFAULT 0 NOT NULL, INDEX slug (slug(191)), INDEX name (name(191)), PRIMARY KEY(term_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wp_usermeta (umeta_id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_id BIGINT UNSIGNED DEFAULT 0 NOT NULL, meta_key VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, meta_value LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX user_id (user_id), INDEX meta_key (meta_key(191)), PRIMARY KEY(umeta_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wp_users (ID BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_login VARCHAR(60) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, user_pass VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, user_nicename VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, user_email VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, user_url VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, user_registered DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, user_activation_key VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, user_status INT DEFAULT 0 NOT NULL, display_name VARCHAR(250) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX user_email (user_email), INDEX user_login_key (user_login), INDEX user_nicename (user_nicename), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE date');
        $this->addSql('DROP TABLE employer');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE evenement_services');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE user');
    }
}
