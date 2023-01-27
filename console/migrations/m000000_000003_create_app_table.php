<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%app}}`.
 */
class m000000_000003_create_app_table extends Migration
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

        $this->createTable('{{%app}}', [
            'IdApp' => $this->primaryKey(),
            'Theme' => $this->string(20)->notNull(),
            'MangaShow' => $this->boolean()->notNull()->defaultValue(true),
            'AnimeShow' => $this->boolean()->notNull()->defaultValue(true),
            'ChapterShow' => $this->boolean()->notNull()->defaultValue(true),
            'User_Id' => $this->integer()->notNull()->unique(),
        ], $tableOptions);

        $this->addForeignKey('fk_app_user', 'app', 'User_Id', 'user', 'IdUser');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%app}}');
    }
}
