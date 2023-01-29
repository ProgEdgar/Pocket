<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "library_list".
 *
 * @property int $IdLibraryList
 * @property string|null $Name
 *
 * @property Library[] $libraries
 * @property User[] $users
 */
class LibraryList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'library_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name'], 'string', 'max' => 20],
            [['Name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdLibraryList' => 'Id Library List',
            'Name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Libraries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLibraries()
    {
        return $this->hasMany(Library::class, ['LibraryList_Id' => 'IdLibraryList']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['PrimaryList_Id' => 'IdLibraryList']);
    }
}
