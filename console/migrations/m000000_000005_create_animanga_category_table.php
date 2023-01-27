<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%animanga_category}}`.
 */
class m000000_000005_create_animanga_category_table extends Migration
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

        $this->createTable('{{%animanga_category}}', [
            'Category_Id' => $this->integer()->notNull(),
            'AniManga_Id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_animanga_category_category', 'animanga_category', 'Category_Id', 'category', 'IdCategory');
        $this->addForeignKey('fk_animanga_category_animanga', 'animanga_category', 'AniManga_Id', 'animanga', 'IdAniManga');

        $this->addPrimaryKey('pk_animanga_category', 'animanga_category', ['Category_Id','AniManga_Id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%animanga_category}}');
    }
}
