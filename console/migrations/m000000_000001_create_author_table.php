<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m000000_000001_create_author_table extends Migration
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

        $this->createTable('{{%author}}', [
            'IdAuthor' => $this->primaryKey(),
            'FirstName' => $this->string(30)->notNull(),
            'LastName' => $this->string(30),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author}}');
    }
}
