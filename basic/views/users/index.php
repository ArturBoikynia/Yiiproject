<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\components\EditPhoto;

/* @var app\models\search\UserSearch $model */

/* @var yii\web\View $this */
/* @var app\models\search\UserSearch $searchModel */
/* @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Yiiusers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yiiusers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->user->can('create')): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Yiiusers'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="col-lg-7">
        <?= GridView::widget([
            'tableOptions' => ['class' => 'table'],
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'label' => 'Avatar',
//                  'encodeLabel' => false,
                    'format' => 'html',
                    'value' => function($data){
                        $image = EditPhoto::findMainPhoto($data->id);
                        return Html::img(['users/image', 'url' => $image->path], [ 'width' => '30', 'height' => '30', 'class' => 'img-circle ']);
                    },
                ],

                [
                    'attribute' => 'name',
                    'format' => 'html',
                    'value' => function($data)
                    {
                        return
                            Html::a($data->name . PHP_EOL . $data->surname, ['/users/view','id'=> $data->id], ['class' => 'btn']);
                    }
                ],

                [
                    'attribute' => 'created_at',
                    'visible' => Yii::$app->user->can('admin'),
                ],

                [
                    'attribute' => 'updated_at',
                    'visible' => Yii::$app->user->can('admin'),
                ],

                [
                    'attribute' => 'is_active',
                    'visible' => Yii::$app->user->can('admin'),
                    'format' => 'boolean',
                ],

                ['class' => ActionColumn::class,
                    'visibleButtons' => [
                        'delete' => Yii::$app->user->can('admin'),
                        'create' => Yii::$app->user->can('admin'),
                        'update' => Yii::$app->user->can('admin'),
                        'view' => Yii::$app->user->can('admin'),
                    ]
                ],
            ],
        ]);
        ?>
    </div>
</div>
<?php
?>
