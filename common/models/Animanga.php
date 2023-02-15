<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animanga".
 *
 * @property int $IdAniManga
 * @property string $Title
 * @property string|null $AlternativeTitle
 * @property string|null $OriginalTitle
 * @property string $Status
 * @property string $Type
 * @property string $Server
 * @property string|null $SrcImage
 * @property float|null $Rating
 * @property string $ReleaseDate
 * @property string $Description
 * @property int|null $ApiAniMangaId
 * @property int|null $Api_Id
 * @property int|null $Manager_Id
 *
 * @property AnimangaAuthor[] $animangaAuthors
 * @property AnimangaCategory[] $animangaCategories
 * @property AnimangaReadsaw[] $animangaReadsaws
 * @property Api $api
 * @property AppLibrary[] $appLibraries
 * @property App[] $apps
 * @property Author[] $authors
 * @property Category[] $categories
 * @property Chep[] $cheps
 * @property Comment[] $comments
 * @property Favorite[] $favorites
 * @property Library[] $libraries
 * @property Manager $manager
 * @property Report[] $reports
 * @property User[] $users
 * @property User[] $users0
 * @property User[] $users1
 */
class Animanga extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animanga';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Title', 'Status', 'Type', 'ReleaseDate', 'Description'], 'required'],
            [['Rating'], 'number'],
            [['ReleaseDate'], 'safe'],
            [['Description'], 'string'],
            [['ApiAniMangaId', 'Api_Id', 'Manager_Id'], 'integer'],
            [['Title', 'AlternativeTitle', 'OriginalTitle'], 'string', 'max' => 100],
            [['Status', 'Type'], 'string', 'max' => 20],
            [['Server'], 'string', 'max' => 10],
            [['SrcImage'], 'string', 'max' => 50],
            [['Api_Id'], 'unique'],
            [['Api_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Api::class, 'targetAttribute' => ['Api_Id' => 'IdApi']],
            [['Manager_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Manager::class, 'targetAttribute' => ['Manager_Id' => 'IdManager']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdAniManga' => 'Id Ani Manga',
            'Title' => 'Title',
            'AlternativeTitle' => 'Alternative Title',
            'OriginalTitle' => 'Original Title',
            'Status' => 'Status',
            'Type' => 'Type',
            'Server' => 'Server',
            'SrcImage' => 'Src Image',
            'Rating' => 'Rating',
            'ReleaseDate' => 'Release Date',
            'Description' => 'Description',
            'ApiAniMangaId' => 'Api Ani Manga ID',
            'Api_Id' => 'Api ID',
            'Manager_Id' => 'Manager ID',
        ];
    }

    /**
     * Gets query for [[AnimangaAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimangaAuthors()
    {
        return $this->hasMany(AnimangaAuthor::class, ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[AnimangaCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimangaCategories()
    {
        return $this->hasMany(AnimangaCategory::class, ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[AnimangaReadsaws]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimangaReadsaws()
    {
        return $this->hasMany(AnimangaReadsaw::class, ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Api]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApi()
    {
        return $this->hasOne(Api::class, ['IdApi' => 'Api_Id']);
    }

    /**
     * Gets query for [[AppLibraries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppLibraries()
    {
        return $this->hasMany(AppLibrary::class, ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Apps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApps()
    {
        return $this->hasMany(App::class, ['IdApp' => 'App_Id'])->viaTable('app_library', ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['IdAuthor' => 'Author_Id'])->viaTable('animanga_author', ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['IdCategory' => 'Category_Id'])->viaTable('animanga_category', ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Cheps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheps()
    {
        return $this->hasMany(Chep::class, ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::class, ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Libraries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLibraries()
    {
        return $this->hasMany(Library::class, ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Manager]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Manager::class, ['IdManager' => 'Manager_Id']);
    }

    /**
     * Gets query for [[Reports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::class, ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['IdUser' => 'User_Id'])->viaTable('animanga_readsaw', ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Users0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::class, ['IdUser' => 'User_Id'])->viaTable('favorite', ['AniManga_Id' => 'IdAniManga']);
    }

    /**
     * Gets query for [[Users1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers1()
    {
        return $this->hasMany(User::class, ['IdUser' => 'User_Id'])->viaTable('library', ['AniManga_Id' => 'IdAniManga']);
    }
}
