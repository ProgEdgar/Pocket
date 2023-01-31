<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "server".
 *
 * @property int $IdServer
 * @property string $Name
 * @property string $Code
 */
class Server extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'server';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'Code'], 'required'],
            [['Name'], 'string', 'max' => 30],
            [['Code'], 'string', 'max' => 10],
            [['Name'], 'unique'],
            [['Code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdServer' => 'Id Server',
            'Name' => 'Name',
            'Code' => 'Code',
        ];
    }
}
