<?php

use yii\helpers\Html;
use app\components\getCurrentUser;
use app\widgets\IconView;

/* @var $this yii\web\View */
/* @var $model app\models\entities\ProgramminglanguagesEntities */


$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Programminglanguages Entities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="programminglanguages-entities-view">

    <h1> User: <?= getCurrentUser::$usersModel->name . ' ' .  getCurrentUser::$usersModel->surname;?></h1>
    <h3 style="text-align: left"> Programming languages </h3>

    <p>
        <?php if(Yii::$app->user->id == $model->user_id):?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>

        <?php if(Yii::$app->user->can('delete')): ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php endif; ?>
   </p>

    <?= IconView::widget([
        'viewObject' => $this,
        'model' => $model,
        'attributes' => [
//            'user_id',
            'c:C',                      // after ":" written name into the cell of table. If without ':name',
            'cPlus:C++',                // will be written to the cell of table, name of column from DataBase table
            'cSharp:C#',
            'go:Go',
            'java:Java',
            'javaScript:JavaScript',
            'matlab:MATLAB',
            'objectiveC:objective-C ',
            'perl:Perl',
            'pascal:Pascal',
            'php:PHP',
            'python:Python',
            'r:R',
            'sql:SQL',
//            'created_at',
//            'updated_at',
        ],
    ]) ?>

</div>
