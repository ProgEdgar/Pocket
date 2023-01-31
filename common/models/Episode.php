<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "episode".
 *
 * @property int $IdEpisode
 * @property int $Ova
 * @property string $SrcVideo
 * @property int $ChEp_Id
 */
class Episode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'episode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Ova', 'ChEp_Id'], 'integer'],
            [['SrcVideo', 'ChEp_Id'], 'required'],
            [['SrcVideo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdEpisode' => 'Id Episode',
            'Ova' => 'Ova',
            'SrcVideo' => 'Src Video',
            'ChEp_Id' => 'Ch Ep ID',
        ];
    }
}
