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
            'Status' => $this->string(20)->notNull(),
            'Type' => $this->string(20)->notNull(),
            'Server' => $this->string(10)->notNull()->defaultValue('en_US'),
            'SrcImage' => $this->string(50),
            'Rating' => $this->float(8,2),
            'ReleaseDate' => $this->date()->notNull(),
            'Description' => $this->text()->notNull(),
            'ApiAniMangaId' => $this->integer(),
            'Api_Id' => $this->integer(),
            'Manager_Id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_animanga_manager', 'animanga', 'Manager_Id', 'manager', 'IdManager');
        $this->addForeignKey('fk_animanga_api', 'animanga', 'Api_Id', 'api', 'IdApi');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%animanga}}');
    }
}
