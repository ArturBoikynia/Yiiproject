<?php


namespace app\models\forms;


use app\models\entities\Yiiusers;
use Yii;
class RegistrationForm extends Yiiusers
{
    public string $repeatPassword = '';

    public function rules(): array
    {

        return array_merge(parent::rules(),
            [
                ['username', 'email'],
                ['name', 'match', 'pattern' => '/[A-Z]{1}[A-Za-z]*/'],
                ['surname', 'match', 'pattern' => '/[A-Z]{1}[A-Za-z]*/'],
                ['password', 'match', 'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&_])[A-Za-z\d@$!%*#?&_]{8,}$/'],
                [['repeatPassword'], 'required'],
                ['repeatPassword', 'compare', 'compareAttribute' => 'password']
            ]);
    }
    public function beforeSave($insert):bool
    {
        $parentBeforeSave =  parent::beforeSave($insert);

        if($parentBeforeSave){
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }

        return $parentBeforeSave;
    }
}

