<?php

namespace app\components\web;

use yii\base\Module;
use yii\web\Controller;
class SecuredController extends Controller
{
    public function __construct(string $id, Module $module, array $config = []){
        parent::__construct($id, $module, $config = []);

        if (\Yii::$app->getUser()->getIsGuest()){
           $this->redirect(['/site/login'])->send();
        };

    }
}