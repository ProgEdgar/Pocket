<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorite}}`.
 */
class m000000_000005_create_favorite_table extends Migration
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

        $this->createTable('{{%favorite}}', [
            'User_Id' => $this->integer()->notNull(),
            'AniManga_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_favorite_user', 'favorite', 'User_Id', 'user', 'IdUser');
        $this->addForeignKey('fk_favorite_animanga', 'favorite', 'AniManga_Id', 'animanga', 'IdAniManga');

        $this->addPrimaryKey('pk_favorite', 'favorite', ['User_Id','AniManga_Id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{favorite}}');
    }
}
