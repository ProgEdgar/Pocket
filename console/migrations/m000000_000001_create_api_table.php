<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%api}}`.
 */
class m000000_000001_create_api_table extends Migration
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

        $this->createTable('{{%api}}', [
            'IdApi' => $this->primaryKey(),
            'Link' => $this->string(200)->notNull(),
            'Type' => $this->boolean()->notNull()->defaultValue(true),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%api}}');
    }
}
