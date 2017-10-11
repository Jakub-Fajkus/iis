<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171011104629 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE drug (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(70) NOT NULL, main_substance VARCHAR(100) NOT NULL, contraindication VARCHAR(3000) DEFAULT NULL, substance_amount VARCHAR(20) NOT NULL, recommended_dosage VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employment (id INT AUTO_INCREMENT NOT NULL, doctor_id INT DEFAULT NULL, department_id INT DEFAULT NULL, type VARCHAR(30) NOT NULL, date_from DATETIME NOT NULL, date_to DATETIME DEFAULT NULL, INDEX fk_doctor_employment (doctor_id), INDEX fk_department_employment (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, shortcut VARCHAR(8) NOT NULL, name VARCHAR(70) NOT NULL, telephone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescritpion (id INT AUTO_INCREMENT NOT NULL, drug_id INT DEFAULT NULL, examination_id INT DEFAULT NULL, period_of_application INT NOT NULL, delivery VARCHAR(30) NOT NULL, amount VARCHAR(30) NOT NULL, INDEX fk_examination_prescription (examination_id), INDEX fk_drug_prescription (drug_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(30) NOT NULL, name VARCHAR(40) NOT NULL, surname VARCHAR(40) NOT NULL, telephone VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_1FC0F36AF85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_5D9F75A192FC23A8 (username_canonical), UNIQUE INDEX UNIQ_5D9F75A1A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_5D9F75A1C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examination (id INT AUTO_INCREMENT NOT NULL, id_hospitalization INT DEFAULT NULL, doctor_id INT DEFAULT NULL, date DATETIME NOT NULL, report VARCHAR(4000) DEFAULT NULL, INDEX fk_doctor_examination (doctor_id), INDEX fk_hospitalization_examination (id_hospitalization), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hospitalization (id INT AUTO_INCREMENT NOT NULL, doctor_id INT DEFAULT NULL, department_id INT DEFAULT NULL, patient_id INT DEFAULT NULL, date_from DATETIME NOT NULL, date_to DATETIME DEFAULT NULL, INDEX fk_doctor_hospitalization (doctor_id), INDEX fk_department_hospitalization (department_id), INDEX fk_patient_hospitalization (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, surname VARCHAR(40) NOT NULL, personal_identification_number VARCHAR(30) NOT NULL, street VARCHAR(50) NOT NULL, house_number VARCHAR(20) NOT NULL, city VARCHAR(50) NOT NULL, zip VARCHAR(20) NOT NULL, medical_identification_number VARCHAR(30) NOT NULL, insurance_company_id INT NOT NULL, gender VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drug_application (id INT AUTO_INCREMENT NOT NULL, id_prescription INT DEFAULT NULL, time DATETIME NOT NULL, appliedBy VARCHAR(30) DEFAULT NULL, INDEX fk_prescription_application (id_prescription), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nurse (id INT AUTO_INCREMENT NOT NULL, department_id INT DEFAULT NULL, username VARCHAR(30) NOT NULL, name VARCHAR(30) NOT NULL, surname VARCHAR(30) NOT NULL, telephone VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_D27E6D43F85E0677 (username), INDEX fk_department_nurse (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employment ADD CONSTRAINT FK_BF089C9887F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
        $this->addSql('ALTER TABLE employment ADD CONSTRAINT FK_BF089C98AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE prescritpion ADD CONSTRAINT FK_655D894EAABCA765 FOREIGN KEY (drug_id) REFERENCES drug (id)');
        $this->addSql('ALTER TABLE prescritpion ADD CONSTRAINT FK_655D894EDAD0CFBF FOREIGN KEY (examination_id) REFERENCES examination (id)');
        $this->addSql('ALTER TABLE examination ADD CONSTRAINT FK_CCDAABC5A991CB19 FOREIGN KEY (id_hospitalization) REFERENCES hospitalization (id)');
        $this->addSql('ALTER TABLE examination ADD CONSTRAINT FK_CCDAABC587F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
        $this->addSql('ALTER TABLE hospitalization ADD CONSTRAINT FK_40CF089187F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
        $this->addSql('ALTER TABLE hospitalization ADD CONSTRAINT FK_40CF0891AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE hospitalization ADD CONSTRAINT FK_40CF08916B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE drug_application ADD CONSTRAINT FK_336E49163C7ECDAB FOREIGN KEY (id_prescription) REFERENCES prescritpion (id)');
        $this->addSql('ALTER TABLE nurse ADD CONSTRAINT FK_D27E6D43AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('INSERT INTO app_user (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles) VALUES (\'admin\', \'admin\', \'admiaus9d8ahsudhaidh@mai.com\', \'admiaus9d8ahsudhaidh@mai.com\', 1, null, \'$2y$13$sZQBwUWW4dnVlLLqdphx6ud29tQtmUucGVhl9TqYkFlqkMylWLujm\', null, null, null, \'a:1:{i:0;s:10:"ROLE_ADMIN";}\');');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prescritpion DROP FOREIGN KEY FK_655D894EAABCA765');
        $this->addSql('ALTER TABLE employment DROP FOREIGN KEY FK_BF089C98AE80F5DF');
        $this->addSql('ALTER TABLE hospitalization DROP FOREIGN KEY FK_40CF0891AE80F5DF');
        $this->addSql('ALTER TABLE nurse DROP FOREIGN KEY FK_D27E6D43AE80F5DF');
        $this->addSql('ALTER TABLE drug_application DROP FOREIGN KEY FK_336E49163C7ECDAB');
        $this->addSql('ALTER TABLE employment DROP FOREIGN KEY FK_BF089C9887F4FB17');
        $this->addSql('ALTER TABLE examination DROP FOREIGN KEY FK_CCDAABC587F4FB17');
        $this->addSql('ALTER TABLE hospitalization DROP FOREIGN KEY FK_40CF089187F4FB17');
        $this->addSql('ALTER TABLE prescritpion DROP FOREIGN KEY FK_655D894EDAD0CFBF');
        $this->addSql('ALTER TABLE examination DROP FOREIGN KEY FK_CCDAABC5A991CB19');
        $this->addSql('ALTER TABLE hospitalization DROP FOREIGN KEY FK_40CF08916B899279');
        $this->addSql('DROP TABLE drug');
        $this->addSql('DROP TABLE employment');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE prescritpion');
        $this->addSql('DROP TABLE doctor');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE examination');
        $this->addSql('DROP TABLE hospitalization');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE drug_application');
        $this->addSql('DROP TABLE nurse');
    }
}
