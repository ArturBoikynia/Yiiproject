<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "school".
 *
 * @property int $id
 * @property int $user_id
 * @property string $nameOfSchool
 * @property string $place
 * @property string|null $specialty
 * @property string|null $begin
 * @property string|null $end
 * @property int|null $to_this_day
 * @property string $created_at
 *
 * @property Yiiusers $user
 */
class SchoolEntities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'school';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'nameOfSchool', 'place'], 'required'],
            [['user_id', 'to_this_day'], 'integer'],
            [['begin', 'end', 'created_at'], 'safe'],
            [['nameOfSchool', 'place', 'specialty'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yiiusers::class, 'targetAttribute' => ['user_id' => 'id']],
            [['end', 'to_this_day'], 'validateToFull', 'skipOnEmpty' => false],
            [['begin'], 'validateFrom', 'skipOnEmpty' => false],
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
            'nameOfSchool' => Yii::t('app', 'Name Of School'),
            'place' => Yii::t('app', 'Place'),
            'specialty' => Yii::t('app', 'Specialty'),
            'begin' => Yii::t('app', 'Begin'),
            'end' => Yii::t('app', 'End'),
            'to_this_day' => Yii::t('app', 'To This Day'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function validateToFull($attribute, $params)
    {
        if ($this->begin && !$this->to_this_day && !$this->end){
            $this->addError($attribute, 'Fields "To present" or "To" must be full');
        }
    }

    public function validateFrom($attribute, $params) {
        if (($this->to_this_day || $this->end) && !$this->begin) {
            $this->addError($attribute, 'Field "From" must be full');
        }
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
