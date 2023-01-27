<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%report}}`.
 */
class m000000_000006_create_report_table extends Migration
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

        $this->createTable('{{report}}', [
            'IdReport' => $this->primaryKey(),
            'SubjectMatter' => $this->string(50)->notNull(),
            'Description' => $this->text()->notNull(),
            'SrcImage' => $this->string(50)->notNull(),
            'Resolved' => $this->boolean()->notNull()->defaultValue(false),
            'Created' => "DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL",
            'Updated' => "DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL",
            'AniManga_Id' => $this->integer(),
            'ChEp_Id' => $this->integer(),
            'User_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_report_animanga', 'report', 'AniManga_Id', 'animanga', 'IdAniManga');
        $this->addForeignKey('fk_report_chep', 'report', 'ChEp_Id', 'chep', 'IdChEp');
        $this->addForeignKey('fk_report_user', 'report', 'User_Id', 'user', 'IdUser');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{report}}');
    }
}
