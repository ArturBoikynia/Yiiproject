<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "high_school".
 *
 * @property int $id
 * @property int $user_id
 * @property string $place
 * @property string $nameOfUni
 * @property string|null $specialty
 * @property string|null $faculty
 * @property string|null $departament
 * @property string|null $degree
 * @property string|null $begin
 * @property string|null $end
 * @property int|null $to_this_day
 * @property string $created_at
 *
 * @property Yiiusers $user
 */
class HighSchoolEntities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'high_school';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'place', 'nameOfUni'], 'required'],
            [['user_id', 'to_this_day'], 'integer'],
            [['begin', 'end', 'created_at'], 'safe'],
            [['place', 'nameOfUni', 'specialty', 'faculty', 'departament', 'degree'], 'string', 'max' => 255],
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
            'place' => Yii::t('app', 'Place'),
            'nameOfUni' => Yii::t('app', 'Name Of Uni'),
            'specialty' => Yii::t('app', 'Specialty'),
            'faculty' => Yii::t('app', 'Faculty'),
            'departament' => Yii::t('app', 'Departament'),
            'degree' => Yii::t('app', 'Degree'),
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
        return $this->hasOne(Yiiusers::className(), ['id' => 'user_id']);
    }
}
