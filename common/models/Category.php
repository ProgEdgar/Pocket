<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $IdCategory
 * @property string $Name
 * @property string $Server
 *
 * @property Animanga[] $aniMangas
 * @property AnimangaCategory[] $animangaCategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['Name', 'Server'], 'string', 'max' => 30],
            [['Name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdCategory' => 'Id Category',
            'Name' => 'Name',
            'Server' => 'Server',
        ];
    }

    /**
     * Gets query for [[AniMangas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAniMangas()
    {
        return $this->hasMany(Animanga::class, ['IdAniManga' => 'AniManga_Id'])->viaTable('animanga_category', ['Category_Id' => 'IdCategory']);
    }

    /**
     * Gets query for [[AnimangaCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimangaCategories()
    {
        return $this->hasMany(AnimangaCategory::class, ['Category_Id' => 'IdCategory']);
    }
}
