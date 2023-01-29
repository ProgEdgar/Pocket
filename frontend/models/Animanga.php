<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animanga".
 *
 * @property int $IdAniManga
 * @property string $Title
 * @property string|null $AlternativeTitle
 * @property string|null $OriginalTitle
 * @property int $Status
 * @property int $OneShotMovie
 * @property int $R18
 * @property string $Server
 * @property string|null $SrcImage
 * @property int $Type
 * @property string $ReleaseDate
 * @property string $Updated
 * @property string $Description
 * @property int $Manager_Id
 *
 * @property AnimangaAuthor[] $animangaAuthors
 * @property AnimangaCategory[] $animangaCategories
 * @property AnimangaReadsaw[] $animangaReadsaws
 * @property AppLibrary[] $appLibraries
 * @property App[] $apps
 * @property Author[] $authors
 * @property Category[] $categories
 * @property Chep[] $cheps
 * @property Comment[] $comments
 * @property Favorite[] $favorites
 * @property Library[] $libraries
 * @property Manager $manager
 * @property Rating[] $ratings
 * @property Report[] $reports
 * @property User[] $users
 * @property User[] $users0
 * @property User[] $users1
 * @property User[] $users2
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
            [['Title', 'ReleaseDate', 'Description', 'Manager_Id'], 'required'],
            [['Status', 'OneShotMovie', 'R18', 'Type', 'Manager_Id'], 'integer'],
            [['ReleaseDate', 'Updated'], 'safe'],
            [['Description'], 'string'],
            [['Title', 'AlternativeTitle', 'OriginalTitle'], 'string', 'max' => 100],
            [['Server'], 'string', 'max' => 10],
            [['SrcImage'], 'string', 'max' => 50],
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
            'OneShotMovie' => 'One Shot Movie',
            'R18' => 'R18',
            'Server' => 'Server',
            'SrcImage' => 'Src Image',
            'Type' => 'Type',
            'ReleaseDate' => 'Release Date',
            'Updated' => 'Updated',
            'Description' => 'Description',
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
     * Gets query for [[Ratings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::class, ['AniManga_Id' => 'IdAniManga']);
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

    /**
     * Gets query for [[Users2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers2()
    {
        return $this->hasMany(User::class, ['IdUser' => 'User_Id'])->viaTable('rating', ['AniManga_Id' => 'IdAniManga']);
    }
}
