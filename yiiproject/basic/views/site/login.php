<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\forms\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';

?>
<div style="margin-top: 10%;">
    <?php $form = ActiveForm::begin(['method' => 'post', 'options'=>['class' => ['col-md-4 col-md-offset-4']]]) ?>
    <h2 class="form-signin-heading text-center"><?=$this->title?></h2>
    <?= $form->field($model, 'username')
        ->textInput()
        ->input('email', ['placeholder' => "Enter Your Email"])
        ->label(false)
    ?>

    <?= $form->field($model, 'password')
        ->passwordInput()
        ->input('password', ['placeholder' => "Enter Your Password"])
        ->label(false)?>

    <?= Html::submitButton('Login', ['class' => 'btn btn-lg btn-primary btn-block'])?>

    <?= Html::a('To Registration', ['site/registration'], ['class' => ' btn btn-lg btn-primary btn-block ']);?>

    <?php ActiveForm::end() ?>
</div>
