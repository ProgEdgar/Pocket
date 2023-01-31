<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "app".
 *
 * @property int $IdApp
 * @property string $Theme
 * @property int $MangaShow
 * @property int $AnimeShow
 * @property int $ChapterShow
 * @property int $User_Id
 *
 * @property Animanga[] $aniMangas
 * @property AppLibrary[] $appLibraries
 * @property User $user
 */
class App extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Theme', 'User_Id'], 'required'],
            [['MangaShow', 'AnimeShow', 'ChapterShow', 'User_Id'], 'integer'],
            [['Theme'], 'string', 'max' => 20],
            [['User_Id'], 'unique'],
            [['User_Id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['User_Id' => 'IdUser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdApp' => 'Id App',
            'Theme' => 'Theme',
            'MangaShow' => 'Manga Show',
            'AnimeShow' => 'Anime Show',
            'ChapterShow' => 'Chapter Show',
            'User_Id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[AniMangas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAniMangas()
    {
        return $this->hasMany(Animanga::class, ['IdAniManga' => 'AniManga_Id'])->viaTable('app_library', ['App_Id' => 'IdApp']);
    }

    /**
     * Gets query for [[AppLibraries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppLibraries()
    {
        return $this->hasMany(AppLibrary::class, ['App_Id' => 'IdApp']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['IdUser' => 'User_Id']);
    }
}
