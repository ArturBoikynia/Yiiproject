<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property int $user_id
 * @property string $path
 * @property int $is_main
 * @property string|null $created_at
 *
 * @property Yiiusers $user
 */
class  PhotoEntities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'path'], 'required'],
            [['user_id', 'is_main'], 'integer'],
            [['created_at'], 'safe'],
            [['path'], 'string', 'max' => 255],
            [['path'], 'unique'],
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
            'path' => Yii::t('app', 'Path'),
            'is_main' => Yii::t('app', 'Is Main'),
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
