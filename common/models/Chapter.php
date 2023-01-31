<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chapter".
 *
 * @property int $IdChapter
 * @property int $PagesNumber
 * @property int $OneShot
 * @property string $SrcFolder
 * @property int $ChEp_Id
 *
 * @property Chep $chEp
 * @property Chep $chEp0
 */
class Chapter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chapter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PagesNumber', 'SrcFolder', 'ChEp_Id'], 'required'],
            [['PagesNumber', 'OneShot', 'ChEp_Id'], 'integer'],
            [['SrcFolder'], 'string', 'max' => 50],
            [['ChEp_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Chep::class, 'targetAttribute' => ['ChEp_Id' => 'IdChEp']],
            [['ChEp_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Chep::class, 'targetAttribute' => ['ChEp_Id' => 'IdChEp']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdChapter' => 'Id Chapter',
            'PagesNumber' => 'Pages Number',
            'OneShot' => 'One Shot',
            'SrcFolder' => 'Src Folder',
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
     * Gets query for [[ChEp0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChEp0()
    {
        return $this->hasOne(Chep::class, ['IdChEp' => 'ChEp_Id']);
    }
}
