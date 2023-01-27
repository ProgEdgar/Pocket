<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%app_library}}`.
 */
class m000000_000005_create_app_library_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if($this->db->driverName === 'mysql'){
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%app_library}}', [
            'App_Id' => $this->integer()->notNull(),
            'AniManga_Id' => $this->integer()->notNull(),
            'List' => "ENUM('1','2','3') NOT NULL",
        ], $tableOptions);

        $this->addForeignKey('fk_app_library_app', 'app_library', 'App_Id', 'app', 'IdApp');
        $this->addForeignKey('fk_app_library_animanga', 'app_library', 'AniManga_Id', 'animanga', 'IdAniManga');

        $this->addPrimaryKey('pk_app_library', 'app_library', ['App_Id','AniManga_Id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%app_library}}');
    }
}
