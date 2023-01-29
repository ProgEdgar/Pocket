<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $IdComment
 * @property string $Comment
 * @property string $Updated
 * @property string $Created
 * @property int $User_Id
 * @property int|null $ChEp_Id
 * @property int|null $AniManga_Id
 * @property int|null $CommentDad_Id
 *
 * @property Animanga $aniManga
 * @property Chep $chEp
 * @property Comment $commentDad
 * @property Comment[] $comments
 * @property Like[] $likes
 * @property User $user
 * @property User[] $users
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Comment', 'User_Id'], 'required'],
            [['Comment'], 'string'],
            [['Updated', 'Created'], 'safe'],
            [['User_Id', 'ChEp_Id', 'AniManga_Id', 'CommentDad_Id'], 'integer'],
            [['AniManga_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Animanga::class, 'targetAttribute' => ['AniManga_Id' => 'IdAniManga']],
            [['ChEp_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Chep::class, 'targetAttribute' => ['ChEp_Id' => 'IdChEp']],
            [['CommentDad_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::class, 'targetAttribute' => ['CommentDad_Id' => 'IdComment']],
            [['User_Id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['User_Id' => 'IdUser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdComment' => 'Id Comment',
            'Comment' => 'Comment',
            'Updated' => 'Updated',
            'Created' => 'Created',
            'User_Id' => 'User ID',
            'ChEp_Id' => 'Ch Ep ID',
            'AniManga_Id' => 'Ani Manga ID',
            'CommentDad_Id' => 'Comment Dad ID',
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
     * Gets query for [[CommentDad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentDad()
    {
        return $this->hasOne(Comment::class, ['IdComment' => 'CommentDad_Id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['CommentDad_Id' => 'IdComment']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::class, ['Comment_Id' => 'IdComment']);
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

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['IdUser' => 'User_Id'])->viaTable('like', ['Comment_Id' => 'IdComment']);
    }
}
