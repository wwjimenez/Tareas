<?php

use yii\db\Migration;

/**
 * Class m190130_141118_migrarbd
 */
class m190130_141118_migrarbd extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         echo "m190130_141118_migrarbd cannot be reverted.\n";
        $resultado= Yii::$app->db->createCommand('CREATE TABLE IF NOT EXISTS `auth_assignment` (
                    `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
                    `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
                    `created_at` int(11) DEFAULT NULL,
                    PRIMARY KEY (`item_name`,`user_id`),
                    KEY `auth_assignment_user_id_idx` (`user_id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;')->execute();
        $resultado2= Yii::$app->db->createCommand('CREATE TABLE IF NOT EXISTS `auth_item` (
                      `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
                      `type` smallint(6) NOT NULL,
                      `description` text COLLATE utf8_unicode_ci,
                      `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
                      `data` blob,
                      `created_at` int(11) DEFAULT NULL,
                      `updated_at` int(11) DEFAULT NULL,
                      PRIMARY KEY (`name`),
                      KEY `rule_name` (`rule_name`),
                      KEY `idx-auth_item-type` (`type`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;')->execute();

        $resultado3= Yii::$app->db->createCommand('CREATE TABLE IF NOT EXISTS `auth_rule` (
                      `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
                      `data` blob,
                      `created_at` int(11) DEFAULT NULL,
                      `updated_at` int(11) DEFAULT NULL,
                      PRIMARY KEY (`name`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');

        

        $resultado6= Yii::$app->db->createCommand('CREATE TABLE IF NOT EXISTS `prioridad` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `prioridad` varchar(100) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;')->execute();
        $resultado7= Yii::$app->db->createCommand('INSERT INTO `prioridad` (`id`, `prioridad`)       VALUES
                    (1, "Baja"),
                    (2, "Media"),
                    (3, "Alta");')->execute();
        $resultado8= Yii::$app->db->createCommand('
                    CREATE TABLE IF NOT EXISTS `tarea` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `idusuario` int(11) NOT NULL,
                      `idprioridad` int(11) NOT NULL,
                      `nombre` varchar(100) NOT NULL,
                      `fecha` datetime NOT NULL,
                      PRIMARY KEY (`id`),
                      KEY `indexusuario` (`idusuario`),
                      KEY `prioridad` (`idprioridad`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;')->execute();

        $resultado9= Yii::$app->db->createCommand('
                    INSERT INTO `tarea` (`id`, `idusuario`, `idprioridad`, `nombre`, `fecha`) VALUES
                    (1, 1, 3, "Limpieza", "2019-03-01 00:00:00"),
                    (2, 1, 3, "Requerimiento", "2019-02-09 00:00:00"),
                    (6, 2, 3, "4444", "2019-02-09 00:00:00"),
                    (7, 1, 2, "asdasd", "2019-02-03 00:00:00"),
                    (8, 1, 3, "asdasdas", "2019-02-04 00:00:00");')->execute();

        $resultado10= Yii::$app->db->createCommand('
                    CREATE TABLE IF NOT EXISTS `user_accounts` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `login` varchar(255) NOT NULL,
                      `username` varchar(255) NOT NULL,
                      `password_hash` varchar(255) NOT NULL,
                      `auth_key` varchar(255) DEFAULT NULL,
                      `administrator` int(11) DEFAULT NULL,
                      `creator` int(11) DEFAULT NULL,
                      `creator_ip` varchar(40) DEFAULT NULL,
                      `confirm_token` varchar(255) DEFAULT NULL,
                      `recovery_token` varchar(255) DEFAULT NULL,
                      `blocked_at` int(11) DEFAULT NULL,
                      `confirmed_at` int(11) DEFAULT NULL,
                      `created_at` int(11) NOT NULL,
                      `updated_at` int(11) NOT NULL,
                      PRIMARY KEY (`id`),
                      UNIQUE KEY `user_unique_login` (`login`),
                      UNIQUE KEY `user_unique_username` (`username`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;')->execute();

        $resultado11= Yii::$app->db->createCommand('
                    INSERT INTO `user_accounts` (`id`, `login`, `username`, `password_hash`, `auth_key`, `administrator`, `creator`, `creator_ip`, `confirm_token`, `recovery_token`, `blocked_at`, `confirmed_at`, `created_at`, `updated_at`) VALUES
                    (1, "walter86.79@gmail.com", "walter86.79@gmail.com", "$2y$13$SQ8UTfGcCZ0d43AYX5ag5u2bWhu/L8LeKel.zVuxS9SEcHPTp052W", NULL, 1, -2, "Local", NULL, NULL, NULL, 1548819201, 1548819201, -1),
                    (2, "walter86@gmail.com", "walter86@gmail.com", "$2y$13$uJBN6ALOqE9BsZdRJlmkNuYCNusxmAbWc9swP/iw9RcVWXYjCvDRS", NULL, 0, 1, "127.0.0.1", NULL, NULL, NULL, 1548830951, 1548830951, -1);')->execute();

        $resultado12= Yii::$app->db->createCommand('
                    ALTER TABLE `tarea`
                      ADD CONSTRAINT `frk_prioridad` FOREIGN KEY (`idprioridad`) REFERENCES `prioridad` (`id`),
                      ADD CONSTRAINT `frk_usuario_tarea` FOREIGN KEY (`idusuario`) REFERENCES `user_accounts` (`id`);
                    ')->execute();
        $resultado13= Yii::$app->db->createCommand('
                    ALTER TABLE `auth_assignment`
                    ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;')->execute();
       
        print_r($resultado);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190130_141118_migrarbd cannot be reverted.\n";

        return false;
    }
    */
}
