<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $IdAuthor
 * @property string $FirstName
 * @property string|null $LastName
 *
 * @property Animanga[] $aniMangas
 * @property AnimangaAuthor[] $animangaAuthors
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FirstName'], 'required'],
            [['FirstName', 'LastName'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdAuthor' => 'Id Author',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
        ];
    }

    /**
     * Gets query for [[AniMangas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAniMangas()
    {
        return $this->hasMany(Animanga::class, ['IdAniManga' => 'AniManga_Id'])->viaTable('animanga_author', ['Author_Id' => 'IdAuthor']);
    }

    /**
     * Gets query for [[AnimangaAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimangaAuthors()
    {
        return $this->hasMany(AnimangaAuthor::class, ['Author_Id' => 'IdAuthor']);
    }
}
