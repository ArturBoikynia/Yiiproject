<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\entities\ProgramminglanguagesEntities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="programminglanguages-entities-form">




    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-4">
        <?= $form->field($model, 'c')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("C")
        ?>

        <?= $form->field($model, 'cPlus')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("C++")
        ?>

        <?= $form->field($model, 'cSharp')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("C#")
        ?>

        <?= $form->field($model, 'go')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("Go")
        ?>

        <?= $form->field($model, 'java')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("Java")
        ?>

        <?= $form->field($model, 'javaScript')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("JavaScript")
        ?>

        <?= $form->field($model, 'matlab')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("MATLAB")
        ?>
    </div>
<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'c')->checkbox() ?>
    <div class="col-lg-4">

        <?= $form->field($model, 'objectiveC')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("Objective-C")
        ?>

        <?= $form->field($model, 'perl')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("Perl")
        ?>

        <?= $form->field($model, 'pascal')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("Pascal")
        ?>

        <?= $form->field($model, 'php')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("PHP")
        ?>

        <?= $form->field($model, 'python')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("Python")
        ?>

        <?= $form->field($model, 'r')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("R")
        ?>

        <?= $form->field($model, 'sql')->widget(SwitchInput::class, ['pluginOptions'=>[
            'handleWidth'=>50,
            'onText'=>'YES',
            'offText'=>'NO'
        ]])->label("SQL")
        ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>


        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-lg mt-10']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
