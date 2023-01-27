<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%like}}`.
 */
class m000000_000007_create_like_table extends Migration
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

        $this->createTable('{{%like}}', [
            'User_Id' => $this->integer()->notNull(),
            'Comment_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_like_user', 'like', 'User_Id', 'user', 'IdUser');
        $this->addForeignKey('fk_like_comment', 'like', 'Comment_Id', 'comment', 'IdComment');

        $this->addPrimaryKey('pk_like', 'like', ['User_Id','Comment_Id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{like}}');
    }
}
