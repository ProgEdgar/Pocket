<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chep".
 *
 * @property int $IdChEp
 * @property float $Number
 * @property string|null $Name
 * @property string $ReleaseDate
 * @property string $Updated
 * @property int|null $Season
 * @property int $AniManga_Id
 * @property int $Manager_Id
 *
 * @property Animanga $aniManga
 * @property Chapter[] $chapters
 * @property Chapter[] $chapters0
 * @property ChepReadsaw[] $chepReadsaws
 * @property Comment[] $comments
 * @property Manager $manager
 * @property Report[] $reports
 * @property User[] $users
 */
class Chep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Number', 'AniManga_Id', 'Manager_Id'], 'required'],
            [['Number'], 'number'],
            [['ReleaseDate', 'Updated'], 'safe'],
            [['Season', 'AniManga_Id', 'Manager_Id'], 'integer'],
            [['Name'], 'string', 'max' => 100],
            [['AniManga_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Animanga::class, 'targetAttribute' => ['AniManga_Id' => 'IdAniManga']],
            [['Manager_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Manager::class, 'targetAttribute' => ['Manager_Id' => 'IdManager']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdChEp' => 'Id Ch Ep',
            'Number' => 'Number',
            'Name' => 'Name',
            'ReleaseDate' => 'Release Date',
            'Updated' => 'Updated',
            'Season' => 'Season',
            'AniManga_Id' => 'Ani Manga ID',
            'Manager_Id' => 'Manager ID',
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
     * Gets query for [[Chapters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChapters()
    {
        return $this->hasMany(Chapter::class, ['ChEp_Id' => 'IdChEp']);
    }

    /**
     * Gets query for [[Chapters0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChapters0()
    {
        return $this->hasMany(Chapter::class, ['ChEp_Id' => 'IdChEp']);
    }

    /**
     * Gets query for [[ChepReadsaws]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChepReadsaws()
    {
        return $this->hasMany(ChepReadsaw::class, ['ChEp_Id' => 'IdChEp']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['ChEp_Id' => 'IdChEp']);
    }

    /**
     * Gets query for [[Manager]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Manager::class, ['IdManager' => 'Manager_Id']);
    }

    /**
     * Gets query for [[Reports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::class, ['ChEp_Id' => 'IdChEp']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['IdUser' => 'User_Id'])->viaTable('chep_readsaw', ['ChEp_Id' => 'IdChEp']);
    }
}
