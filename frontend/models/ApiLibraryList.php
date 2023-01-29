<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "api_library_list".
 *
 * @property int $IdApiLibraryList
 * @property string $List
 * @property int $AniMangaCode
 * @property string $AniMangaInfo
 * @property int $Api_Id
 * @property int $User_Id
 *
 * @property Api $api
 * @property User $user
 */
class ApiLibraryList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api_library_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['List', 'AniMangaCode', 'AniMangaInfo', 'Api_Id', 'User_Id'], 'required'],
            [['List', 'AniMangaInfo'], 'string'],
            [['AniMangaCode', 'Api_Id', 'User_Id'], 'integer'],
            [['Api_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Api::class, 'targetAttribute' => ['Api_Id' => 'IdApi']],
            [['User_Id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['User_Id' => 'IdUser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdApiLibraryList' => 'Id Api Library List',
            'List' => 'List',
            'AniMangaCode' => 'Ani Manga Code',
            'AniMangaInfo' => 'Ani Manga Info',
            'Api_Id' => 'Api ID',
            'User_Id' => 'User ID',
        ];
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['IdUser' => 'User_Id']);
    }
}
