<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%library}}`.
 */
class m000000_000005_create_library_table extends Migration
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

        $this->createTable('{{%library}}', [
            'User_Id' => $this->integer()->notNull(),
            'AniManga_Id' => $this->integer()->notNull(),
            'LibraryList_Id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_library_user', 'library', 'User_Id', 'user', 'IdUser');
        $this->addForeignKey('fk_library_animanga', 'library', 'AniManga_Id', 'animanga', 'IdAniManga');
        $this->addForeignKey('fk_library_list', 'library', 'LibraryList_Id', 'library_list', 'IdLibraryList');

        $this->addPrimaryKey('pk_library', 'library', ['User_Id','AniManga_Id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{library}}');
    }
}
