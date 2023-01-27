<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%manager}}`.
 */
class m000000_000003_create_manager_table extends Migration
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

        $this->createTable('{{%manager}}', [
            'IdManager' => $this->primaryKey(),
            'Theme' => $this->boolean()->notNull()->defaultValue(true),
            'Status' => $this->boolean()->notNull()->defaultValue(true),
            'User_Id' => $this->integer()->notNull()->unique(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%manager}}');
    }
}
