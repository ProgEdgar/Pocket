<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%episode}}`.
 */
class m000000_000006_create_episode_table extends Migration
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

        $this->createTable('{{%episode}}', [
            'IdEpisode' => $this->primaryKey(),
            'Ova' => $this->boolean()->notNull()->defaultValue(false),
            'SrcVideo' => $this->string(50)->notNull(),
            'ChEp_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_episode_chep', 'chapter', 'ChEp_Id', 'chep', 'IdChEp');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%episode}}');
    }
}
