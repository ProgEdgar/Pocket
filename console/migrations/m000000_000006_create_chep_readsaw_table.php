<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chep_readsaw}}`.
 */
class m000000_000006_create_chep_readsaw_table extends Migration
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

        $this->createTable('{{%chep_readsaw}}', [
            'User_Id' => $this->integer()->notNull(),
            'ChEp_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_chep_readsaw_user', 'chep_readsaw', 'User_Id', 'user', 'IdUser');
        $this->addForeignKey('fk_chep_readsaw_animanga', 'chep_readsaw', 'ChEp_Id', 'chep', 'IdChEp');

        $this->addPrimaryKey('pk_chep_readsaw', 'chep_readsaw', ['User_Id','ChEp_Id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{chep_readsaw}}');
    }
}
