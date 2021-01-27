<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "friends".
 *
 * @property int $id
 * @property int $user_id
 * @property int $friend_id
 * @property string $username
 * @property string $created_at
 *
 * @property Yiiusers $friend
 * @property Yiiusers $user
 */
class FriendsEntities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'friends';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'friend_id', 'username'], 'required'],
            [['user_id', 'friend_id'], 'integer'],
            [['created_at'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['friend_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yiiusers::className(), 'targetAttribute' => ['friend_id' => 'id']],
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
            'friend_id' => Yii::t('app', 'Friend ID'),
            'username' => Yii::t('app', 'Username'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Friend]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFriend()
    {
        return $this->hasOne(Yiiusers::className(), ['id' => 'friend_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Yiiusers::className(), ['id' => 'user_id']);
    }
}
