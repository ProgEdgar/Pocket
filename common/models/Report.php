<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property int $IdReport
 * @property string $SubjectMatter
 * @property string $Description
 * @property string $SrcImage
 * @property int $Resolved
 * @property string $Created
 * @property string $Updated
 * @property int|null $AniManga_Id
 * @property int|null $ChEp_Id
 * @property int $User_Id
 *
 * @property Animanga $aniManga
 * @property Chep $chEp
 * @property User $user
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SubjectMatter', 'Description', 'SrcImage', 'User_Id'], 'required'],
            [['Description'], 'string'],
            [['Resolved', 'AniManga_Id', 'ChEp_Id', 'User_Id'], 'integer'],
            [['Created', 'Updated'], 'safe'],
            [['SubjectMatter', 'SrcImage'], 'string', 'max' => 50],
            [['AniManga_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Animanga::class, 'targetAttribute' => ['AniManga_Id' => 'IdAniManga']],
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
            'IdReport' => 'Id Report',
            'SubjectMatter' => 'Subject Matter',
            'Description' => 'Description',
            'SrcImage' => 'Src Image',
            'Resolved' => 'Resolved',
            'Created' => 'Created',
            'Updated' => 'Updated',
            'AniManga_Id' => 'Ani Manga ID',
            'ChEp_Id' => 'Ch Ep ID',
            'User_Id' => 'User ID',
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
