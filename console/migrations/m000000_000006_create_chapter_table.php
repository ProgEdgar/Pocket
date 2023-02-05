<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chapter}}`.
 */
class m000000_000006_create_chapter_table extends Migration
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

        $this->createTable('{{%chapter}}', [
            'IdChapter' => $this->primaryKey(),
            'PagesNumber' => $this->integer()->notNull(),
            'SrcFolder' => $this->string(50)->notNull(),
            'ChEp_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_chapter_chep', 'chapter', 'ChEp_Id', 'chep', 'IdChEp');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chapter}}');
    }
}
