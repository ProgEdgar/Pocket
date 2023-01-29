<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "api".
 *
 * @property int $IdApi
 * @property string $Link
 * @property int $Type
 *
 * @property ApiLibraryList[] $apiLibraryLists
 */
class Api extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Link'], 'required'],
            [['Type'], 'integer'],
            [['Link'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdApi' => 'Id Api',
            'Link' => 'Link',
            'Type' => 'Type',
        ];
    }

    /**
     * Gets query for [[ApiLibraryLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApiLibraryLists()
    {
        return $this->hasMany(ApiLibraryList::class, ['Api_Id' => 'IdApi']);
    }
}
