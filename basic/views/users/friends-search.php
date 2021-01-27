<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\forms\FriendsSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var app\models\entities\Yiiusers|app\models\forms\RegistrationForm $userModel */
?>

<div class="friends-entities-search">

    <?php $form = ActiveForm::begin([
        'action' => ['friends', 'id'=> $userModel->id],
        'method' => 'get',
    ]); ?>

<!--    --><?//= $form->field($model, 'id') ?>

<!--    --><?//= $form->field($model, 'user_id')->hiddenInput(['value' => $userModel->id, 'onchange' => 'this.form.submit();'])->label(false)?>

<!--    --><?//= $form->field($model, 'friend_id') ?>

    <?= $form->field($model, 'username')->label('Search Friends') ?>

<!--    --><?//= $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>