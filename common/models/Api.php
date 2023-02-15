<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "api".
 *
 * @property int $IdApi
 * @property string $Name
 * @property string $Link
 * @property int $IsAnime
 * @property string|null $Data
 * @property string|null $GenresLink
 * @property string|null $GenresId
 * @property string|null $GenresName
 * @property string|null $SearchPage
 * @property string|null $SearchTotal
 * @property string|null $SearchLimit
 * @property string|null $SearchName
 * @property string|null $SearchType
 * @property string|null $SearchStatus
 * @property string|null $SearchWGenres
 * @property string|null $SearchWOutGenres
 * @property string|null $SearchOrderBy
 * @property string|null $SearchSortBy
 * @property string|null $AMSearchLink
 * @property string $AMLink
 * @property string $AMId
 * @property string|null $AMTitle
 * @property string|null $AMAlternativeTitle
 * @property string|null $AMOriginalTitle
 * @property string|null $AMStatus
 * @property string|null $AMStatusOptions
 * @property string|null $AMOrderByOptions
 * @property string|null $AMSortByOptions
 * @property string|null $AMType
 * @property string|null $AMTypeOptions
 * @property string|null $AMGenre
 * @property string|null $AMGenreName
 * @property string|null $AMReleaseDate
 * @property string|null $AMImage
 * @property string|null $AMRating
 * @property string|null $AMRatingOptions
 * @property string|null $AMDescription
 * @property string|null $AMAuthor
 * @property string|null $AMAuthorName
 * @property string|null $AMCEQuantity
 * @property string|null $CELink
 * @property string|null $CEId
 * @property string|null $CENumber
 * @property string|null $CEReleaseDate
 * @property string|null $CETitle
 * @property string|null $CESeason
 *
 * @property Animanga $animanga
 * @property User[] $users
 */
class Api extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'Link', 'IsAnime', 'AMLink', 'AMId'], 'required'],
            [['IsAnime'], 'integer'],
            [['Name', 'Data', 'GenresId', 'GenresName', 'SearchTotal', 'AMId', 'AMTitle', 'AMAlternativeTitle', 'AMOriginalTitle', 'AMStatus', 'AMType', 'AMGenre', 'AMGenreName', 'AMReleaseDate', 'AMImage', 'AMRating', 'AMDescription', 'AMAuthor', 'AMAuthorName', 'AMCEQuantity', 'CEId', 'CENumber', 'CEReleaseDate', 'CETitle', 'CESeason'], 'string', 'max' => 100],
            [['Link', 'GenresLink', 'AMSearchLink', 'AMLink', 'CELink'], 'string', 'max' => 200],
            [['SearchPage', 'SearchLimit', 'SearchName', 'SearchType', 'SearchStatus', 'SearchWGenres', 'SearchWOutGenres', 'SearchOrderBy', 'SearchSortBy'], 'string', 'max' => 50],
            [['AMStatusOptions', 'AMOrderByOptions', 'AMSortByOptions', 'AMTypeOptions', 'AMRatingOptions'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdApi' => 'Id Api',
            'Name' => 'Name',
            'Link' => 'Link',
            'IsAnime' => 'Is Anime',
            'Data' => 'Data',
            'GenresLink' => 'Genres Link',
            'GenresId' => 'Genres ID',
            'GenresName' => 'Genres Name',
            'SearchPage' => 'Search Page',
            'SearchTotal' => 'Search Total',
            'SearchLimit' => 'Search Limit',
            'SearchName' => 'Search Name',
            'SearchType' => 'Search Type',
            'SearchStatus' => 'Search Status',
            'SearchWGenres' => 'Search W Genres',
            'SearchWOutGenres' => 'Search W Out Genres',
            'SearchOrderBy' => 'Search Order By',
            'SearchSortBy' => 'Search Sort By',
            'AMSearchLink' => 'Am Search Link',
            'AMLink' => 'Am Link',
            'AMId' => 'Am ID',
            'AMTitle' => 'Am Title',
            'AMAlternativeTitle' => 'Am Alternative Title',
            'AMOriginalTitle' => 'Am Original Title',
            'AMStatus' => 'Am Status',
            'AMStatusOptions' => 'Am Status Options',
            'AMOrderByOptions' => 'Am Order By Options',
            'AMSortByOptions' => 'Am Sort By Options',
            'AMType' => 'Am Type',
            'AMTypeOptions' => 'Am Type Options',
            'AMGenre' => 'Am Genre',
            'AMGenreName' => 'Am Genre Name',
            'AMReleaseDate' => 'Am Release Date',
            'AMImage' => 'Am Image',
            'AMRating' => 'Am Rating',
            'AMRatingOptions' => 'Am Rating Options',
            'AMDescription' => 'Am Description',
            'AMAuthor' => 'Am Author',
            'AMAuthorName' => 'Am Author Name',
            'AMCEQuantity' => 'Amce Quantity',
            'CELink' => 'Ce Link',
            'CEId' => 'Ce ID',
            'CENumber' => 'Ce Number',
            'CEReleaseDate' => 'Ce Release Date',
            'CETitle' => 'Ce Title',
            'CESeason' => 'Ce Season',
        ];
    }

    /**
     * Gets query for [[Animanga]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimanga()
    {
        return $this->hasOne(Animanga::class, ['Api_Id' => 'IdApi']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['Api_Id' => 'IdApi']);
    }
}
