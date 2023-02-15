<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $IdUser
 * @property string $Username
 * @property string $Email
 * @property string $Gender
 * @property string $BirthDate
 * @property string|null $SrcPhoto
 * @property int $Theme
 * @property string $AniMangaShow
 * @property int $ChapterShow
 * @property string $Server
 * @property int $PrimaryList_Id
 * @property int|null $Api_Id
 * @property string $LastVisit
 * @property string $Created
 * @property string $Updated
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property int $status
 * @property string|null $verification_token
 *
 * @property Animanga[] $aniMangas
 * @property Animanga[] $aniMangas0
 * @property Animanga[] $aniMangas1
 * @property AnimangaReadsaw[] $animangaReadsaws
 * @property Api $api
 * @property App $app
 * @property Chep[] $chEps
 * @property ChepReadsaw[] $chepReadsaws
 * @property Comment[] $comments
 * @property Comment[] $comments0
 * @property Favorite[] $favorites
 * @property Library[] $libraries
 * @property Like[] $likes
 * @property LibraryList $primaryList
 * @property Report[] $reports
 */
class User  extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Username', 'Email', 'Gender', 'BirthDate', 'AniMangaShow', 'auth_key', 'password_hash'], 'required'],
            [['Gender', 'AniMangaShow'], 'string'],
            [['BirthDate', 'LastVisit', 'Created', 'Updated'], 'safe'],
            [['Theme', 'ChapterShow', 'PrimaryList_Id', 'Api_Id', 'status'], 'integer'],
            [['Username', 'SrcPhoto'], 'string', 'max' => 50],
            [['Email', 'password_hash', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['Server'], 'string', 'max' => 10],
            [['auth_key'], 'string', 'max' => 32],
            [['Username'], 'unique'],
            [['Email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['Api_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Api::class, 'targetAttribute' => ['Api_Id' => 'IdApi']],
            [['PrimaryList_Id'], 'exist', 'skipOnError' => true, 'targetClass' => LibraryList::class, 'targetAttribute' => ['PrimaryList_Id' => 'IdLibraryList']],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdUser' => 'Id User',
            'Username' => 'Username',
            'Email' => 'Email',
            'Gender' => 'Gender',
            'BirthDate' => 'Birth Date',
            'SrcPhoto' => 'Src Photo',
            'Theme' => 'Theme',
            'AniMangaShow' => 'Ani Manga Show',
            'ChapterShow' => 'Chapter Show',
            'Server' => 'Server',
            'PrimaryList_Id' => 'Primary List ID',
            'Api_Id' => 'Api ID',
            'LastVisit' => 'Last Visit',
            'Created' => 'Created',
            'Updated' => 'Updated',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($IdUser)
    {
        return static::findOne(['IdUser' => $IdUser, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $Username
     * @return static|null
     */
    public static function findByUsername($Username)
    {
        return static::findOne(['Username' => $Username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($Password)
    {
        return Yii::$app->security->validatePassword($Password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($Password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($Password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Gets query for [[AniMangas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAniMangas()
    {
        return $this->hasMany(Animanga::class, ['IdAniManga' => 'AniManga_Id'])->viaTable('animanga_readsaw', ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[AniMangas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAniMangas0()
    {
        return $this->hasMany(Animanga::class, ['IdAniManga' => 'AniManga_Id'])->viaTable('favorite', ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[AniMangas1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAniMangas1()
    {
        return $this->hasMany(Animanga::class, ['IdAniManga' => 'AniManga_Id'])->viaTable('library', ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[AnimangaReadsaws]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimangaReadsaws()
    {
        return $this->hasMany(AnimangaReadsaw::class, ['User_Id' => 'IdUser']);
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
     * Gets query for [[App]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApp()
    {
        return $this->hasOne(App::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[ChEps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChEps()
    {
        return $this->hasMany(Chep::class, ['IdChEp' => 'ChEp_Id'])->viaTable('chep_readsaw', ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[ChepReadsaws]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChepReadsaws()
    {
        return $this->hasMany(ChepReadsaw::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[Comments0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments0()
    {
        return $this->hasMany(Comment::class, ['IdComment' => 'Comment_Id'])->viaTable('like', ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[Libraries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLibraries()
    {
        return $this->hasMany(Library::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::class, ['User_Id' => 'IdUser']);
    }

    /**
     * Gets query for [[PrimaryList]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrimaryList()
    {
        return $this->hasOne(LibraryList::class, ['IdLibraryList' => 'PrimaryList_Id']);
    }

    /**
     * Gets query for [[Reports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::class, ['User_Id' => 'IdUser']);
    }
}
