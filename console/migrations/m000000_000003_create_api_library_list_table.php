<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%api_library_list}}`.
 */
class m000000_000003_create_api_library_list_table extends Migration
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

        $this->createTable('{{%api_library_list}}', [
            'IdApiLibraryList' => $this->primaryKey(),
            'List' => "ENUM('1','2','3') NOT NULL",
            'AniMangaCode' => $this->integer()->notNull(),
            'AniMangaInfo' => $this->text()->notNull(),
            'Api_Id' => $this->integer()->notNull(),
            'User_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_api_library_list_api', 'api_library_list', 'Api_Id', 'api', 'IdApi');
        $this->addForeignKey('fk_api_library_list_user', 'api_library_list', 'User_Id', 'user', 'IdUser');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%api_library_list}}');
    }
}
