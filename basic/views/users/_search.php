<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var yii\web\View $this */
/* @var app\models\search\UserSearch $model */
/* @var  yii\widgets\ActiveForm $form */

?>

<div class="yiiusers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options'=>['class' => ['col-md-4 col-md-offset-3']]
    ]); ?>


<!--    --><?//= $form->field($model, 'id') ?>

<!--    --><?//= $form->field($model, 'email') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'surname') ?>

    <?php if(Yii::$app->user->can('admin')): ?>

        <div class="form-group">
            <label class="control-label"><?= Yii::t('app','Created Time')?></label>
            <?=
            DatePicker::widget([
                    'class' => ['mb-5'],
                'model' => $model,

//                'label' => Yii::t('app','Created Time'),
                'attribute' =>'created_at',
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])
            ?>
        </div>

    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

