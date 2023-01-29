<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_library".
 *
 * @property int $App_Id
 * @property int $AniManga_Id
 * @property string $List
 *
 * @property Animanga $aniManga
 * @property App $app
 */
class AppLibrary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_library';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['App_Id', 'AniManga_Id', 'List'], 'required'],
            [['App_Id', 'AniManga_Id'], 'integer'],
            [['List'], 'string'],
            [['App_Id', 'AniManga_Id'], 'unique', 'targetAttribute' => ['App_Id', 'AniManga_Id']],
            [['AniManga_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Animanga::class, 'targetAttribute' => ['AniManga_Id' => 'IdAniManga']],
            [['App_Id'], 'exist', 'skipOnError' => true, 'targetClass' => App::class, 'targetAttribute' => ['App_Id' => 'IdApp']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'App_Id' => 'App ID',
            'AniManga_Id' => 'Ani Manga ID',
            'List' => 'List',
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
     * Gets query for [[App]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApp()
    {
        return $this->hasOne(App::class, ['IdApp' => 'App_Id']);
    }
}
