<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m000000_000002_create_user_table extends Migration
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

        $this->createTable('{{%user}}', [
            'IdUser' => $this->primaryKey(),
            'Username' => $this->string(50)->notNull()->unique(),
            'Email' => $this->string()->notNull()->unique(),
            'Gender' => "ENUM('F','M','U') NOT NULL",
            'BirthDate' => $this->date()->notNull(),
            'SrcPhoto' => $this->string(50),

            'Theme' => $this->boolean()->notNull()->defaultValue(true),
            'AniMangaShow' => "ENUM('1','2','3') NOT NULL",
            'ChapterShow' => $this->boolean()->notNull()->defaultValue(true),
            'Server' => $this->string(10)->notNull()->defaultValue('en_US'),
            'PrimaryList_Id' => $this->integer()->notNull()->defaultValue(1),
            'Api_Id' => $this->integer(),

            'LastVisit' => "DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL",
            'Created' => "DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL",
            'Updated' => "DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL",

            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
        ], $tableOptions);

        $this->addForeignKey('fk_user_library_list', 'user', 'PrimaryList_Id', 'library_list', 'IdLibraryList');
        $this->addForeignKey('fk_user_api', 'user', 'Api_Id', 'api', 'IdApi');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
