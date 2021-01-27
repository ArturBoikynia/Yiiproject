<?php

namespace app\models;

use app\exceptions\InvalidException;
use app\models\entities\Yiiusers;
use yii\web\IdentityInterface;
use Yii;
use \yii\base\InvalidArgumentException;
class User extends Yiiusers implements IdentityInterface
{
    public static function findIdentity($id):?self
    {
        return self::findOne($id);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username):?self
    {
        return self::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }


    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password)
    {
        try{
            return Yii::$app->security->validatePassword($password, $this->password);
        }catch (InvalidArgumentException $exception){
            return false;
        }
    }

    /**
     * @param mixed $token
     * @param null $type
     */
    public static function findIdentityByAccessToken($token, $type = null):void
    {
    }

    public function getAuthKey()
    {
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey):bool
    {
        return false;
    }
}
