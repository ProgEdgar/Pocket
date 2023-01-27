<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%animanga_author}}`.
 */
class m000000_000005_create_animanga_author_table extends Migration
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

        $this->createTable('{{%animanga_author}}', [
            'Author_Id' => $this->integer()->notNull(),
            'AniManga_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_animanga_author_author', 'animanga_author', 'Author_Id', 'author', 'IdAuthor');
        $this->addForeignKey('fk_animanga_author_animanga', 'animanga_author', 'AniManga_Id', 'animanga', 'IdAniManga');

        $this->addPrimaryKey('pk_animanga_author', 'animanga_author', ['Author_Id','AniManga_Id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%animanga_author}}');
    }
}
