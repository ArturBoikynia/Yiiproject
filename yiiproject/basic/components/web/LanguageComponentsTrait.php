<?php


namespace app\components\web;

use Yii;
trait LanguageComponentsTrait
{
    public function getLanguage(): LanguageComponent
    {
        return Yii::$app->get('language');
    }
}