<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animanga_author".
 *
 * @property int $Author_Id
 * @property int $AniManga_Id
 *
 * @property Animanga $aniManga
 * @property Author $author
 */
class AnimangaAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animanga_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Author_Id', 'AniManga_Id'], 'required'],
            [['Author_Id', 'AniManga_Id'], 'integer'],
            [['Author_Id', 'AniManga_Id'], 'unique', 'targetAttribute' => ['Author_Id', 'AniManga_Id']],
            [['AniManga_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Animanga::class, 'targetAttribute' => ['AniManga_Id' => 'IdAniManga']],
            [['Author_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['Author_Id' => 'IdAuthor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Author_Id' => 'Author ID',
            'AniManga_Id' => 'Ani Manga ID',
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
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['IdAuthor' => 'Author_Id']);
    }
}
