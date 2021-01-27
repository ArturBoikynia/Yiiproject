<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "skills".
 *
 * @property int $id
 * @property int $user_id
 * @property string $skill
 * @property string|null $created_at
 *
 * @property Yiiusers $user
 */
class SkillsEntities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'skill'], 'required'],
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['skill'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yiiusers::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'skill' => Yii::t('app', 'Skill'),
            'created_at' => Yii::t('app', 'Created At'),
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
