<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $IdUser
 * @property string $Username
 * @property string $Email
 * @property string $Gender
 * @property string $BirthDate
 * @property string|null $SrcPhoto
 * @property int $Theme
 * @property string $AniMangaShow
 * @property int $ChapterShow
 * @property string $Server
 * @property int $PrimaryList_Id
 * @property string $LastVisit
 * @property string $Created
 * @property string $Updated
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property int $status
 * @property string|null $verification_token
 *
 * @property Animanga[] $aniMangas
 * @property Animanga[] $aniMangas0
 * @property Animanga[] $aniMangas1
 * @property Animanga[] $aniMangas2
 * @property AnimangaReadsaw[] $animangaReadsaws
 * @property ApiLibraryList[] $apiLibraryLists
 * @property App $app
 * @property Chep[] $chEps
 * @property ChepReadsaw[] $chepReadsaws
 * @property Comment[] $comments
 * @property Comment[] $comments0
 * @property Favorite[] $favorites
 * @property Library[] $libraries
 * @property Like[] $likes
 * @property LibraryList $primaryList
 * @property Rating[] $ratings
 * @property Report[] $reports
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Username', 'Email', 'Gender', 'BirthDate', 'AniMangaShow', 'auth_key', 'password_hash'], 'required'],
            [['Gender', 'AniMangaShow'], 'string'],
            [['BirthDate', 'LastVisit', 'Created', 'Updated'], 'safe'],
            [['Theme', 'ChapterShow', 'PrimaryList_Id', 'status'], 'integer'],
            [['Username', 'SrcPhoto'], 'string', 'max' => 50],
            [['Email', 'password_hash', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['Server'], 'string', 'max' => 10],
            [['auth_key'], 'string', 'max' => 32],
            [['Username'], 'unique'],
            [['Email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['PrimaryList_Id'], 'exist', 'skipOnError' => true, 'targetClass' => LibraryList::class, 'targetAttribute' => ['PrimaryList_Id' => 'IdLibraryList']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdUser' => 'Id User',
            'Username' => 'Username',
            'Email' => 'Email',
            'Gender' => 'Gender',
            'BirthDate' => 'Birth Date',
            'SrcPhoto' => 'Src Photo',
            'Theme' => 'Theme',
            'AniMangaShow' => 'Ani Manga Show',
            'ChapterShow' => 'Chapter Show',
            'Server' => 'Server',
            'PrimaryList_Id' => 'Primary List ID',
            'LastVisit' => 'Last Visit',
            'Created' => 'Created',
            'Updated' => 'Updated',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * Gets query for [[AniMangas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAniMangas()
    {
        return $this->hasMany(Animanga::class, ['IdAniManga' => 'AniManga_Id'])->viaTable('animanga_readsaw', ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[AniMangas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAniMangas0()
    {
        return $this->hasMany(Animanga::class, ['IdAniManga' => 'AniManga_Id'])->viaTable('favorite', ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[AniMangas1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAniMangas1()
    {
        return $this->hasMany(Animanga::class, ['IdAniManga' => 'AniManga_Id'])->viaTable('library', ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[AniMangas2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAniMangas2()
    {
        return $this->hasMany(Animanga::class, ['IdAniManga' => 'AniManga_Id'])->viaTable('rating', ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[AnimangaReadsaws]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimangaReadsaws()
    {
        return $this->hasMany(AnimangaReadsaw::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[ApiLibraryLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApiLibraryLists()
    {
        return $this->hasMany(ApiLibraryList::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[App]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApp()
    {
        return $this->hasOne(App::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[ChEps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChEps()
    {
        return $this->hasMany(Chep::class, ['IdChEp' => 'ChEp_Id'])->viaTable('chep_readsaw', ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[ChepReadsaws]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChepReadsaws()
    {
        return $this->hasMany(ChepReadsaw::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[Comments0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments0()
    {
        return $this->hasMany(Comment::class, ['IdComment' => 'Comment_Id'])->viaTable('like', ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[Libraries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLibraries()
    {
        return $this->hasMany(Library::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[PrimaryList]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrimaryList()
    {
        return $this->hasOne(LibraryList::class, ['IdLibraryList' => 'PrimaryList_Id']);
    }

    /**
     * Gets query for [[Ratings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[Reports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::class, ['User_Id' => 'IdUser']);
    }
}
