<?php

namespace app\models\entities;

use app\models\entities\PhotoEntities;
use SebastianBergmann\CodeCoverage\Report\PHP;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Html;


/**
 * This is the model class for table "yiiusers".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $surname
 * @property string $password
 * @property bool $is_active
 * @property string $created_at
 * @property string|null $updated_at
 *  @property PhotoEntities[] $images
 *  @property SkillsEntities[] $skills
 *
 */
class Yiiusers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yiiusers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['username', 'name', 'surname', 'password'], 'required'],
            [['is_active'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'name', 'surname'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels():array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'password' => Yii::t('app', 'Password'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getImages(): ActiveQuery
    {
        return $this->hasMany(PhotoEntities::class, ['user_id' => 'id']);
    }
    public function getSkills(): ActiveQuery
    {
        return $this->hasMany(SkillsEntities::class, ['user_id' => 'id']);
    }

    public function getUsername()
    {
        return $this->surname . PHP_EOL . $this->name;
    }

    public function getAvatar()
    {
       $getMain = (new PhotoEntities())::findOne(['user_id' => $this->id, 'is_main' => true]);

       return ['users/image', 'url' => $getMain->path];

    }
}
