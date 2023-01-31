<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "library".
 *
 * @property int $User_Id
 * @property int $AniManga_Id
 * @property int|null $LibraryList_Id
 *
 * @property Animanga $aniManga
 * @property LibraryList $libraryList
 * @property User $user
 */
class Library extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'library';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['User_Id', 'AniManga_Id'], 'required'],
            [['User_Id', 'AniManga_Id', 'LibraryList_Id'], 'integer'],
            [['User_Id', 'AniManga_Id'], 'unique', 'targetAttribute' => ['User_Id', 'AniManga_Id']],
            [['AniManga_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Animanga::class, 'targetAttribute' => ['AniManga_Id' => 'IdAniManga']],
            [['LibraryList_Id'], 'exist', 'skipOnError' => true, 'targetClass' => LibraryList::class, 'targetAttribute' => ['LibraryList_Id' => 'IdLibraryList']],
            [['User_Id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['User_Id' => 'IdUser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'User_Id' => 'User ID',
            'AniManga_Id' => 'Ani Manga ID',
            'LibraryList_Id' => 'Library List ID',
        ];
    }

    /**
     * Gets query for [[AniManga]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAniManga()
    {
        return $this->hasOne(Animanga::class, ['IdAniManga' => 'AniManga_Id']);
    }

    /**
     * Gets query for [[LibraryList]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLibraryList()
    {
        return $this->hasOne(LibraryList::class, ['IdLibraryList' => 'LibraryList_Id']);
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
