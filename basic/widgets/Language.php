<?php


namespace app\widgets;

use app\models\forms\LanguagesForm;
use Yii;
use yii\bootstrap\Widget;
use yii\bootstrap\ActiveForm;

class Language extends Widget
{

    public function run()
    {
        $model = new LanguagesForm();
        $model->language = Yii::$app->language;


        $form = ActiveForm::begin(['method' => 'post', 'action' => ['/site/language']]);
        echo $form->field($model, 'language')->dropDownList(Yii::$app->params['languages'], ['onchange' => 'this.form.submit();'])->label(false);
        ActiveForm::end();

    }
}