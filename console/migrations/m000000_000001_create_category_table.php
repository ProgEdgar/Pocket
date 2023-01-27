<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m000000_000001_create_category_table extends Migration
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

        $this->createTable('{{%category}}', [
            'IdCategory' => $this->primaryKey(),
            'Name' => $this->string(30)->notNull()->unique(),
            'Server' => $this->string(30)->notNull()->defaultValue('en_US'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
