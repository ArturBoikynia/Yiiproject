<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "programminglanguages".
 *
 * @property int $id
 * @property int $user_id
 * @property int $c
 * @property int $cPlus
 * @property int $cSharp
 * @property int $go
 * @property int $java
 * @property int $javaScript
 * @property int $matlab
 * @property int $objectiveC
 * @property int $perl
 * @property int $pascal
 * @property int $php
 * @property int $python
 * @property int $r
 * @property int $sql
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Yiiusers $user
 */
class ProgramminglanguagesEntities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'programminglanguages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'c', 'cPlus', 'cSharp', 'go', 'java', 'javaScript', 'matlab', 'objectiveC', 'perl', 'pascal', 'php', 'python', 'r', 'sql'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yiiusers::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'c' => Yii::t('app', 'C'),
            'cPlus' => Yii::t('app', 'C Plus'),
            'cSharp' => Yii::t('app', 'C Sharp'),
            'go' => Yii::t('app', 'Go'),
            'java' => Yii::t('app', 'Java'),
            'javaScript' => Yii::t('app', 'Java Script'),
            'matlab' => Yii::t('app', 'Matlab'),
            'objectiveC' => Yii::t('app', 'Objective C'),
            'perl' => Yii::t('app', 'Perl'),
            'pascal' => Yii::t('app', 'Pascal'),
            'php' => Yii::t('app', 'Php'),
            'python' => Yii::t('app', 'Python'),
            'r' => Yii::t('app', 'R'),
            'sql' => Yii::t('app', 'Sql'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Yiiusers::class, ['id' => 'user_id']);
    }
}
