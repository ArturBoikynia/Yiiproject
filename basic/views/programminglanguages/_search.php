<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ProgramminglanguagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="programminglanguages-entities-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'c') ?>

    <?= $form->field($model, 'cPlus') ?>

    <?= $form->field($model, 'cSharp') ?>

    <?= $form->field($model, 'go') ?>

    <?php // echo $form->field($model, 'java') ?>

    <?php // echo $form->field($model, 'javaScript') ?>

    <?php // echo $form->field($model, 'matlab') ?>

    <?php // echo $form->field($model, 'objectiveC') ?>

    <?php // echo $form->field($model, 'perl') ?>

    <?php // echo $form->field($model, 'pascal') ?>

    <?php // echo $form->field($model, 'php') ?>

    <?php // echo $form->field($model, 'python') ?>

    <?php // echo $form->field($model, 'r') ?>

    <?php // echo $form->field($model, 'sql') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
