<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animanga_category".
 *
 * @property int $Category_Id
 * @property int $AniManga_Id
 *
 * @property Animanga $aniManga
 * @property Category $category
 */
class AnimangaCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animanga_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Category_Id', 'AniManga_Id'], 'required'],
            [['Category_Id', 'AniManga_Id'], 'integer'],
            [['Category_Id', 'AniManga_Id'], 'unique', 'targetAttribute' => ['Category_Id', 'AniManga_Id']],
            [['AniManga_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Animanga::class, 'targetAttribute' => ['AniManga_Id' => 'IdAniManga']],
            [['Category_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['Category_Id' => 'IdCategory']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Category_Id' => 'Category ID',
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
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['IdCategory' => 'Category_Id']);
    }
}
