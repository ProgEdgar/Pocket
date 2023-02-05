<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chep}}`.
 */
class m000000_000005_create_chep_table extends Migration
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

        $this->createTable('{{%chep}}', [
            'IdChEp' => $this->primaryKey(),
            'Number' => $this->float(7,4)->notNull(),
            'Title' => $this->string(100),
            'Type' => $this->string(20)->notNull(),
            'ReleaseDate' => "DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL",
            'Season' => $this->integer(),
            'AniManga_Id' => $this->integer()->notNull(),
            'Manager_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_chep_animanga', 'chep', 'AniManga_Id', 'animanga', 'IdAniManga');
        $this->addForeignKey('fk_chep_manager', 'chep', 'Manager_Id', 'manager', 'IdManager');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chep}}');
    }
}
