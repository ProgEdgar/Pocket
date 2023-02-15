<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%api}}`.
 */
class m000000_000001_create_api_table extends Migration
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

        $this->createTable('{{%api}}', [ // Most Fields is to know the name that has to be used; ex: if want id, in api may appear as mal_id
            'IdApi' => $this->primaryKey(),
            'Name' => $this->string(100)->notNull(),
            'Link' => $this->string(200)->notNull(),
            'IsAnime' => $this->boolean()->notNull(),
            'Data' => $this->string(100),
            'GenresLink' => $this->string(200),
            'GenresId' => $this->string(100),
            'GenresName' => $this->string(100),
            'SearchPage' => $this->string(50),
            'SearchTotal' => $this->string(100),
            'SearchLimit' => $this->string(50),
            'SearchName' => $this->string(50),
            'SearchType' => $this->string(50),
            'SearchStatus' => $this->string(50),
            'SearchWGenres' => $this->string(50),
            'SearchWOutGenres' => $this->string(50),
            'SearchOrderBy' => $this->string(50),
            'SearchSortBy' => $this->string(50),
            'AMSearchLink' => $this->string(200),
            'AMLink' => $this->string(200)->notNull(),
            'AMId' => $this->string(100)->notNull(),
            'AMTitle' => $this->string(100),
            'AMAlternativeTitle' => $this->string(100),
            'AMOriginalTitle' => $this->string(100),
            'AMStatus' => $this->string(100),
            'AMStatusOptions' => $this->string(500),
            'AMOrderByOptions' => $this->string(500),
            'AMSortByOptions' => $this->string(500),
            'AMType' => $this->string(100),
            'AMTypeOptions' => $this->string(500),
            'AMGenre' => $this->string(100),
            'AMGenreName' => $this->string(100),
            'AMReleaseDate' => $this->string(100),
            'AMImage' => $this->string(100),
            'AMRating' => $this->string(100),
            'AMRatingOptions' => $this->string(500),
            'AMDescription' => $this->string(100),
            'AMAuthor' => $this->string(100),
            'AMAuthorName' => $this->string(100),
            'AMCEQuantity' => $this->string(100),
            'CELink' => $this->string(200),
            'CEId' => $this->string(100),
            'CENumber' => $this->string(100),
            'CEReleaseDate' => $this->string(100),
            'CETitle' => $this->string(100),
            'CESeason' => $this->string(100),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%api}}');
    }
}
