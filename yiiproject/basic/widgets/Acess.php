<?php
namespace app\widgets;

use Yii;
use yii\bootstrap\Widget;
use mdm\admin\components\MenuHelper;
use \yii\bootstrap\Nav;

class Acess extends Widget
{

    public function run()
    {
        echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav navbar-right'],
        'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
    ]);
    }
}