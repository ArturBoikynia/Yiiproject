<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "experience".
 *
 * @property int $id
 * @property int $user_id
 * @property string $company
 * @property string $post
 * @property string $areaOfEmployment
 * @property string|null $from
 * @property string|null $to
 * @property int|null $to_this_day
 * @property string $created_at
 *
 * @property Yiiusers $user
 */
class ExperienceEntities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experience';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'company', 'post', 'areaOfEmployment'], 'required'],
            [['user_id', 'to_this_day'], 'integer'],
            [['from', 'to', 'created_at'], 'safe'],
            [['company', 'post', 'areaOfEmployment'], 'string', 'max' => 3000],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yiiusers::class, 'targetAttribute' => ['user_id' => 'id']],
            [['to', 'to_this_day'], 'validateToFull'],
            [['from'], 'validateFrom'],
        ];
    }


    public function validateToFull($attribute, $params)
    {
        if ($this->from && !$this->to_this_day && !$this->to){
            $this->addError($attribute, 'Fields "To present" or "To" must be full');
        }
    }

    public function validateFrom($attribute, $params) {
        if (($this->to_this_day || $this->to) && !$this->from) {
         $this->addError($attribute, 'Field "From" must be full');
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'company' => Yii::t('app', 'Company'),
            'post' => Yii::t('app', 'Post'),
            'areaOfEmployment' => Yii::t('app', 'Area Of Employment'),
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To'),
            'to_this_day' => Yii::t('app', 'To This Day'),
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
