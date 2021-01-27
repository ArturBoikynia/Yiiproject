<?php

use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var app\models\forms\RegistrationForm $model*/

$this->title = Yii::t('app', 'Create Yiiusers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yiiusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yiiusers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
