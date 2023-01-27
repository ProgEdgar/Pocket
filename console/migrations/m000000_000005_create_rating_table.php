<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rating}}`.
 */
class m000000_000005_create_rating_table extends Migration
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

        $this->createTable('{{%rating}}', [
            'User_Id' => $this->integer()->notNull(),
            'AniManga_Id' => $this->integer()->notNull(),
            'LibraryList_Id' => "ENUM('1','2','3','4','5') NOT NULL",
        ], $tableOptions);

        $this->addForeignKey('fk_rating_user', 'rating', 'User_Id', 'user', 'IdUser');
        $this->addForeignKey('fk_rating_animanga', 'rating', 'AniManga_Id', 'animanga', 'IdAniManga');

        $this->addPrimaryKey('pk_rating', 'rating', ['User_Id','AniManga_Id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{rating}}');
    }
}
