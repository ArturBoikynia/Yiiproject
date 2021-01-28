<?php


namespace app\components;


use app\models\entities\Yiiusers;

class getCurrentUser
{
    static public ?Yiiusers $usersModel = null;

    public function __construct(?Yiiusers $usersModel)
    {
        self::$usersModel = $usersModel;
    }
}