<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chep_readsaw".
 *
 * @property int $User_Id
 * @property int $ChEp_Id
 *
 * @property Chep $chEp
 * @property User $user
 */
class ChepReadsaw extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chep_readsaw';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['User_Id', 'ChEp_Id'], 'required'],
            [['User_Id', 'ChEp_Id'], 'integer'],
            [['User_Id', 'ChEp_Id'], 'unique', 'targetAttribute' => ['User_Id', 'ChEp_Id']],
            [['ChEp_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Chep::class, 'targetAttribute' => ['ChEp_Id' => 'IdChEp']],
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
            'ChEp_Id' => 'Ch Ep ID',
        ];
    }

    /**
     * Gets query for [[ChEp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChEp()
    {
        return $this->hasOne(Chep::class, ['IdChEp' => 'ChEp_Id']);
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
