<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%animanga}}`.
 */
class m000000_000004_create_animanga_table extends Migration
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

        $this->createTable('{{%animanga}}', [
            'IdAniManga' => $this->primaryKey(),
            'Title' => $this->string(100)->notNull(),
            'AlternativeTitle' => $this->string(100),
            'OriginalTitle' => $this->string(100),
            'Status' => $this->boolean()->notNull()->defaultValue(false),
            'OneShotMovie' => $this->boolean()->notNull()->defaultValue(false),
            'R18' => $this->boolean()->notNull()->defaultValue(false),
            'Server' => $this->string(10)->notNull()->defaultValue('en_US'),
            'SrcImage' => $this->string(50),
            'Type' => $this->boolean()->notNull()->defaultValue(false),
            'ReleaseDate' => $this->date()->notNull(),
            'Updated' => "DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL",
            'Description' => $this->text()->notNull(),
            'Manager_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_animanga_manager', 'animanga', 'Manager_Id', 'manager', 'IdManager');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%animanga}}');
    }
}
