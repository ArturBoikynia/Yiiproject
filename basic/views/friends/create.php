<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\entities\FriendsEntities */

$this->title = Yii::t('app', 'Create Friends Entities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Friends Entities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friends-entities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
