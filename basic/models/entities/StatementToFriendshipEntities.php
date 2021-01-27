<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "statement_to_friendship".
 *
 * @property int $id
 * @property int $user_ask_id
 * @property int $user_answer_id
 * @property int $ask
 * @property int|null $answer
 * @property int|null $reject
 * @property string $created_at
 *
 * @property Yiiusers $userAnswer
 * @property Yiiusers $userAsk
 */
class StatementToFriendshipEntities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statement_to_friendship';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_ask_id', 'user_answer_id', 'ask'], 'required'],
            [['user_ask_id', 'user_answer_id', 'ask', 'answer', 'reject'], 'integer'],
            [['created_at'], 'safe'],
            [['user_answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yiiusers::class, 'targetAttribute' => ['user_answer_id' => 'id']],
            [['user_ask_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yiiusers::class, 'targetAttribute' => ['user_ask_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_ask_id' => Yii::t('app', 'User Ask ID'),
            'user_answer_id' => Yii::t('app', 'User Answer ID'),
            'ask' => Yii::t('app', 'Ask'),
            'answer' => Yii::t('app', 'Answer'),
            'reject' => Yii::t('app', 'Reject'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[UserAnswer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserAnswer()
    {
        return $this->hasOne(Yiiusers::class, ['id' => 'user_answer_id']);
    }

    /**
     * Gets query for [[UserAsk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserAsk()
    {
        return $this->hasOne(Yiiusers::class, ['id' => 'user_ask_id']);
    }
}
