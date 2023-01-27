<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%library_list}}`.
 */
class m000000_000001_create_library_list_table extends Migration
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

        $this->createTable('{{%library_list}}', [
            'IdLibraryList' => $this->primaryKey(),
            'Name' => $this->string(20)->unique(),
        ], $tableOptions);

        $this->insert('{{library_list}}', [
            'Name' => 'Uncategorized',
        ]);

        $this->insert('{{library_list}}', [
            'Name' => 'To Read',
        ]);

        $this->insert('{{library_list}}', [
            'Name' => 'Reading',
        ]);

        $this->insert('{{library_list}}', [
            'Name' => 'Completed',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%library_list}}');
    }
}
