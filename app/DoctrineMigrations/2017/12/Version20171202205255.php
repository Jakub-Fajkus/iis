<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171202205255 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('INSERT INTO `department` VALUES (5,\'DA\',\'Dětské oddělení A\',\'762785468\');');
        $this->addSql('INSERT INTO `employee` VALUES (9,\'lpe\',\'lpe\',\'lpe@nemocnice.cz\',\'lpe@nemocnice.cz\',1,NULL,\'$2y$13$FyrI4wRGhsvaKjguboSxNePrN.Gmxe7Z0YgpM4prWA2QCaXjqRkz.\',NULL,NULL,NULL,\'a:1:{i:0;s:10:\"ROLE_NURSE\";}\',\'Lenka\',\'Peprná\',\'789624862\',\'nurse\'),(10,\'kka\',\'kka\',\'kka@nemocnice.cz\',\'kka@nemocnice.cz\',1,NULL,\'$2y$13$8TZRSlMpTPsyiWvMQHmRDetlURoXaUW8Wsyp1HNR5neG08OsVa0W.\',NULL,NULL,NULL,\'a:1:{i:0;s:11:\"ROLE_DOCTOR\";}\',\'Karel\',\'Karlovič\',\'456852624\',\'doctor\'),(11,\'lje\',\'lje\',\'lje@nemocnice.cz\',\'lje@nemocnice.cz\',1,NULL,\'$2y$13$tXRfr85VtEvg0LNGKndghO7sgCsvolnIsd8/P2qBdhI6kd4Xue1Gq\',NULL,NULL,NULL,\'a:1:{i:0;s:10:\"ROLE_ADMIN\";}\',\'Leroy\',\'Jenkins\',\'785624685\',\'employee\');');
        $this->addSql('INSERT INTO `doctor` VALUES (10);');

        $this->addSql('INSERT INTO `drug` VALUES (2,\'Panadol\',\'panlolen\',\'Žádná\',\'400mg\',\'1xdenně\'),(3,\'5-Fluorouracil\',\'5-Fluorouracil\',\'Žádné\',\'100mg\',\'1xdenně\'),(4,\'ACC\',\'ACC\',\'Žádné\',\'100mg\',\'1xdenně\'),(5,\'APO-Brusinky Forte\',\'APO-Brusinky Forte\',\'Žádné\',\'100mg\',\'1xdenně\'),(6,\'APO-Brusinky Strong\',\'APO-Brusinky Strong\',\'Žádné\',\'100mg\',\'1xdenně\'),(7,\'Abaktal\',\'Abaktal\',\'Žádné\',\'100mg\',\'1xdenně\'),(8,\'Abasaglar\',\'Abasaglar\',\'Žádné\',\'100mg\',\'1xdenně\'),(9,\'Abelcet\',\'Abelcet\',\'Žádné\',\'100mg\',\'1xdenně\'),(10,\'Abella\',\'Abella\',\'Žádné\',\'100mg\',\'1xdenně\'),(11,\'Abilify\',\'Abilify\',\'Žádné\',\'100mg\',\'1xdenně\'),(12,\'Abraxane\',\'Abraxane\',\'Žádné\',\'100mg\',\'1xdenně\'),(13,\'Abseamed\',\'Abseamed\',\'Žádné\',\'100mg\',\'1xdenně\'),(14,\'Absenor\',\'Absenor\',\'Žádné\',\'100mg\',\'1xdenně\'),(15,\'Abuxar\',\'Abuxar\',\'Žádné\',\'100mg\',\'1xdenně\');');

        $this->addSql('INSERT INTO `patient` VALUES (3,\'Pepa\',\'Nemocny\',\'112233/4466\',\'Nemoc\',\'205\',\'Brno\',\'60308\',\'112233/4466\',123,0),(4,\'Marie\',\'Maran\',\'111112/1223\',\'ulice1\',\'1\',\'Mesto1\',\'60001\',\'111112/1223\',123,0),(5,\'Jiří\',\'Jiřan\',\'111113/1223\',\'ulice2\',\'2\',\'Mesto2\',\'60002\',\'111113/1223\',123,0),(6,\'Jan\',\'Jaan\',\'111114/1223\',\'ulice3\',\'3\',\'Mesto3\',\'60003\',\'111114/1223\',123,0),(7,\'Jana\',\'Janan\',\'111115/1223\',\'ulice4\',\'4\',\'Mesto4\',\'60004\',\'111115/1223\',123,0),(8,\'Petr\',\'Petan\',\'111116/1223\',\'ulice5\',\'5\',\'Mesto5\',\'60005\',\'111116/1223\',123,0),(9,\'Josef\',\'Josan\',\'111117/1223\',\'ulice6\',\'6\',\'Mesto6\',\'60006\',\'111117/1223\',123,0),(10,\'Pavel\',\'Pavan\',\'111118/1223\',\'ulice7\',\'7\',\'Mesto7\',\'60007\',\'111118/1223\',123,0),(11,\'Jaroslav\',\'Jaran\',\'111119/1223\',\'ulice8\',\'8\',\'Mesto8\',\'60008\',\'111119/1223\',123,0),(12,\'Martin\',\'Maran\',\'111120/1223\',\'ulice9\',\'9\',\'Mesto9\',\'60009\',\'111120/1223\',123,0),(13,\'Miroslav\',\'Miran\',\'111121/1223\',\'ulice10\',\'10\',\'Mesto10\',\'60010\',\'111121/1223\',123,0),(14,\'Tomáš\',\'Toman\',\'111122/1223\',\'ulice11\',\'11\',\'Mesto11\',\'60011\',\'111122/1223\',123,0),(15,\'Eva\',\'Evan\',\'111123/1223\',\'ulice12\',\'12\',\'Mesto12\',\'60012\',\'111123/1223\',123,0),(16,\'František\',\'Fraan\',\'111124/1223\',\'ulice13\',\'13\',\'Mesto13\',\'60013\',\'111124/1223\',123,0),(17,\'Anna\',\'Annan\',\'111125/1223\',\'ulice14\',\'14\',\'Mesto14\',\'60014\',\'111125/1223\',123,0),(18,\'Hana\',\'Hanan\',\'111126/1223\',\'ulice15\',\'15\',\'Mesto15\',\'60015\',\'111126/1223\',123,0),(19,\'Zdeněk\',\'Zdean\',\'111127/1223\',\'ulice16\',\'16\',\'Mesto16\',\'60016\',\'111127/1223\',123,0),(20,\'Václav\',\'Vácan\',\'111128/1223\',\'ulice17\',\'17\',\'Mesto17\',\'60017\',\'111128/1223\',123,0),(21,\'Věra\',\'Věran\',\'111129/1223\',\'ulice18\',\'18\',\'Mesto18\',\'60018\',\'111129/1223\',123,0),(22,\'Karel\',\'Karan\',\'111130/1223\',\'ulice19\',\'19\',\'Mesto19\',\'60019\',\'111130/1223\',123,0),(23,\'Lenka\',\'Lenan\',\'111131/1223\',\'ulice20\',\'20\',\'Mesto20\',\'60020\',\'111131/1223\',123,0),(24,\'Milan\',\'Milan\',\'111132/1223\',\'ulice21\',\'21\',\'Mesto21\',\'60021\',\'111132/1223\',123,0),(25,\'Michal\',\'Mican\',\'111133/1223\',\'ulice22\',\'22\',\'Mesto22\',\'60022\',\'111133/1223\',123,0),(26,\'Alena\',\'Alean\',\'111134/1223\',\'ulice23\',\'23\',\'Mesto23\',\'60023\',\'111134/1223\',123,0),(27,\'Kateřina\',\'Katan\',\'111135/1223\',\'ulice24\',\'24\',\'Mesto24\',\'60024\',\'111135/1223\',123,0),(28,\'Petra\',\'Petan\',\'111136/1223\',\'ulice25\',\'25\',\'Mesto25\',\'60025\',\'111136/1223\',123,0),(29,\'Lucie\',\'Lucan\',\'111137/1223\',\'ulice26\',\'26\',\'Mesto26\',\'60026\',\'111137/1223\',123,0);');

        $this->addSql('INSERT INTO `hospitalization` VALUES (5,7,3,3,\'2017-12-02 14:27:00\',NULL),(6,7,3,4,\'2017-12-02 15:35:00\',NULL),(7,7,3,6,\'2017-12-02 19:19:00\',NULL),(8,7,3,8,\'2017-12-02 19:20:00\',NULL),(9,7,3,10,\'2017-12-02 19:20:00\',NULL),(10,7,3,12,\'2017-12-02 19:19:00\',NULL),(11,7,3,14,\'2017-12-02 19:19:00\',NULL),(12,7,3,18,\'2017-12-02 19:19:00\',NULL),(13,7,3,20,\'2017-12-02 19:20:00\',NULL),(14,7,3,22,\'2017-12-02 19:20:00\',NULL),(15,7,3,24,\'2017-12-02 19:21:00\',NULL),(16,7,3,26,\'2017-12-02 19:21:00\',NULL),(17,7,3,28,\'2017-12-02 19:21:00\',NULL);');

        $this->addSql('INSERT INTO `examination` VALUES (3,5,NULL,\'2017-12-02 14:29:20\',\'Nemocný\'),(4,6,NULL,\'2017-12-02 19:23:39\',\'Vysetreni 1\'),(5,7,NULL,\'2017-12-02 19:23:44\',\'Vysetreni 2\'),(6,8,NULL,\'2017-12-02 19:23:50\',\'Vysetreni 3\'),(7,9,NULL,\'2017-12-02 19:23:56\',\'Vysetreni 4\'),(8,10,NULL,\'2017-12-02 19:24:00\',\'Vysetreni 5\'),(9,11,NULL,\'2017-12-02 19:24:06\',\'Vysetreni 6\'),(10,12,NULL,\'2017-12-02 19:24:09\',\'Vysetreni 7\'),(11,13,NULL,\'2017-12-02 19:24:14\',\'Vysetreni 8\'),(12,14,NULL,\'2017-12-02 19:24:20\',\'Vysetreni 9\'),(13,16,NULL,\'2017-12-02 19:24:28\',\'Vysetreni 11\'),(14,17,NULL,\'2017-12-02 19:24:33\',\'Vysetreni 12\'),(15,15,NULL,\'2017-12-02 19:26:49\',\'Vysetreni 10\');');

        $this->addSql('INSERT INTO `prescritpion` VALUES (2,1,3,6,\'Perorální\',\'100mg\'),(3,1,4,6,\'Perorální\',\'200mg\'),(4,1,5,6,\'Perorální\',\'200mg\'),(5,1,6,6,\'Perorální\',\'200mg\'),(6,1,7,6,\'Perorální\',\'200mg\'),(7,1,8,2,\'Perorální\',\'200mg\'),(8,1,9,8,\'Perorální\',\'200mg\'),(9,1,10,12,\'Perorální\',\'200mg\'),(10,1,11,24,\'Perorální\',\'200mg\'),(11,1,12,4,\'Perorální\',\'200mg\'),(12,1,15,9,\'Perorální\',\'200mg\'),(13,1,13,14,\'Perorální\',\'200mg\'),(14,1,14,3,\'Perorální\',\'200mg\');');

        $this->addSql('INSERT INTO `drug_application` VALUES (1,2,\'2017-12-02 14:34:00\',\'lpe\'),(2,2,\'2017-12-02 14:34:00\',\'lpe\'),(3,3,\'2017-12-02 19:26:00\',\'doctor\'),(4,3,\'2017-12-02 20:36:00\',\'doctor\'),(5,4,\'2017-12-02 20:35:00\',\'doctor\'),(6,5,\'2017-12-02 20:35:00\',\'doctor\'),(7,6,\'2017-12-02 20:35:00\',\'doctor\'),(8,8,\'2017-12-02 20:35:00\',\'doctor\'),(9,7,\'2017-12-02 20:35:00\',\'doctor\'),(10,9,\'2017-12-02 20:35:00\',\'doctor\'),(11,10,\'2017-12-02 20:35:00\',\'doctor\'),(12,11,\'2017-12-02 20:36:00\',\'doctor\'),(13,12,\'2017-12-02 20:36:00\',\'doctor\'),(14,13,\'2017-12-02 20:36:00\',\'doctor\'),(15,14,\'2017-12-02 20:36:00\',\'doctor\');');

        $this->addSql('INSERT INTO `employment` VALUES (1,10,3,\'Plný\',\'2017-12-02 14:52:00\',NULL,\'123456798\');');

        $this->addSql('INSERT INTO `nurse` VALUES (9,5);');
    }

    public function down(Schema $schema)
    {
    }
}
