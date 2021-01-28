<?php


namespace app\controllers;

use app\components\web\SecuredController;
use Yii;
class MenuController extends SecuredController
{
    public function actionIndex(){

        $this->layout = 'main';
        $this->view->title = Yii::t('app', 'Main Menu') ;
        return $this->render('index');
    }
}