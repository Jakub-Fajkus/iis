<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171110134535 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO symfony.department (id, shortcut, name, telephone) VALUES (3, 'ARO', 'Anesteziologicko Resuscitacni Oddeleni', '341213123');");
        $this->addSql("INSERT INTO symfony.department (id, shortcut, name, telephone) VALUES (4, 'JIP', 'Jednotka Intenzivni Pece', '6054335555');");
        $this->addSql("INSERT INTO symfony.drug (id, name, main_substance, contraindication, substance_amount, recommended_dosage) VALUES (1, 'Paralen', 'paracetamol', 'tehotenstvi', '400mg', '3xdenne');");
        $this->addSql('INSERT INTO symfony.employee (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles, name, surname, telephone, discr) VALUES (1, \'admin\', \'admin\', \'asdad@sdadasd.sds\', \'asdad@sdadasd.sds\', 1, null, \'$2y$13$V9pVmGe7mjaBclVhSSoBAO6C7vZMccv05AXq5vZ5V4jx1y/IyAipS\', \'2017-11-12 11:06:45\', null, null, \'a:1:{i:0;s:10:"ROLE_ADMIN";}\', null, null, null, \'employee\');');
        $this->addSql('INSERT INTO symfony.employee (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles, name, surname, telephone, discr) VALUES (6, \'nurse\', \'nurse\', \'nurse@jakubfajkus.cz\', \'nurse@jakubfajkus.cz\', 1, null, \'$2y$13$NUwR3oUDcC5mwBpMRQdvkOSXfd.IjXM8/42pAl9A2/A5PZERfaBLm\', \'2017-11-12 11:07:01\', null, null, \'a:1:{i:0;s:10:"ROLE_NURSE";}\', null, null, null, \'nurse\');');
        $this->addSql('INSERT INTO symfony.employee (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles, name, surname, telephone, discr) VALUES (7, \'doctor\', \'doctor\', \'doctor@jakubfajkus.cz\', \'doctor@jakubfajkus.cz\', 1, null, \'$2y$13$oA18QQFWCQS3Pc13aJjHVeNQL1k2Hs7fWfSBu1H.SXet6FIzHrhUm\', \'2017-11-10 13:54:17\', null, null, \'a:1:{i:0;s:11:"ROLE_DOCTOR";}\', null, null, null, \'doctor\');');
        $this->addSql('INSERT INTO symfony.employee (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles, name, surname, telephone, discr) VALUES (8, \'superAdmin\', \'superadmin\', \'superAdmin@jakubfajkus.cz\', \'superadmin@jakubfajkus.cz\', 1, null, \'$2y$13$7mJVIjSsh8MzdKUjQu.X.urK5e.gXUmNLHDOgqAUO1kEllHLjHPmK\', \'2017-11-12 11:12:03\', null, null, \'a:5:{i:0;s:16:"ROLE_SUPER_ADMIN";i:1;s:10:"ROLE_ADMIN";i:2;s:12:"ROLE_MEDICAL";i:3;s:10:"ROLE_NURSE";i:4;s:11:"ROLE_DOCTOR";}\', null, null, null, \'employee\');');
        $this->addSql("INSERT INTO symfony.doctor (id) VALUES (7);");
        $this->addSql("INSERT INTO symfony.nurse (id, department_id) VALUES (6, 3);");
        $this->addSql("INSERT INTO symfony.patient (id, name, surname, personal_identification_number, street, house_number, city, zip, medical_identification_number, insurance_company_id, gender) VALUES (2, 'Jakub', 'Fajkus', 'pid', 'Lejskova 313', 'Lejskova 313', 'Petrvald', '73541', '4567', 217, 'MA');");
        $this->addSql("INSERT INTO symfony.hospitalization (id, doctor_id, department_id, patient_id, date_from, date_to) VALUES (4, 7, 3, 2, '2017-11-10 14:01:04', null);");
        $this->addSql("INSERT INTO symfony.examination (id, id_hospitalization, doctor_id, date, report) VALUES (1, 4, 7, '2017-11-10 14:01:51', 'zdravy!');");
        $this->addSql("INSERT INTO symfony.examination (id, id_hospitalization, doctor_id, date, report) VALUES (2, 4, 7, '2017-11-10 14:03:42', 'dd');");
        $this->addSql("INSERT INTO symfony.prescritpion (drug_id, examination_id, period_of_application, delivery, amount) VALUES (1, 2, 8, 'oral', '2');");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
