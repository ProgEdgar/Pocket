<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manager".
 *
 * @property int $IdManager
 * @property int $Theme
 * @property int $Status
 * @property int $User_Id
 *
 * @property Animanga[] $animangas
 * @property Chep[] $cheps
 */
class Manager extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manager';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Theme', 'Status', 'User_Id'], 'integer'],
            [['User_Id'], 'required'],
            [['User_Id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdManager' => 'Id Manager',
            'Theme' => 'Theme',
            'Status' => 'Status',
            'User_Id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Animangas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimangas()
    {
        return $this->hasMany(Animanga::class, ['Manager_Id' => 'IdManager']);
    }

    /**
     * Gets query for [[Cheps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheps()
    {
        return $this->hasMany(Chep::class, ['Manager_Id' => 'IdManager']);
    }
}
