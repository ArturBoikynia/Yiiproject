<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var yii\web\View $this*/
/* @var app\models\entities\Yiiusers|app\models\forms\RegistrationForm $model  */
/* @var yii\widgets\ActiveForm $form */
?>

<div class="yiiusers-form">

    <?php $form = ActiveForm::begin(['options'=>['class' => ['col-md-4 col-md-offset-3']]]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label(Yii::t('app', 'Email')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?php if ($model->isNewRecord) : ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true]) ?>

    <?php endif;?>


    <?= $form->field($model, 'is_active')->dropDownList([
        0 => 'off',
        1 => 'on',

    ])?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
