<?php


namespace app\components\web;

use Yii;
use yii\base\Component;
class LanguageComponent extends Component
{
    private const LANGUAGE_PARAM = 'currentLanguage';

    public function init(): void
    {
        Yii::$app->language = Yii::$app->session->get(self::LANGUAGE_PARAM, Yii::$app->language);

    }

    public function set(string $language): void
    {
        Yii::$app->session->set(self::LANGUAGE_PARAM, $language);
    }
}