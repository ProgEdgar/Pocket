<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%animanga_readsaw}}`.
 */
class m000000_000005_create_animanga_readsaw_table extends Migration
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

        $this->createTable('{{%animanga_readsaw}}', [
            'User_Id' => $this->integer()->notNull(),
            'AniManga_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_animanga_readsaw_user', 'animanga_readsaw', 'User_Id', 'user', 'IdUser');
        $this->addForeignKey('fk_animanga_readsaw_animanga', 'animanga_readsaw', 'AniManga_Id', 'animanga', 'IdAniManga');

        $this->addPrimaryKey('pk_animanga_readsaw', 'animanga_readsaw', ['User_Id','AniManga_Id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%animanga_readsaw}}');
    }
}
