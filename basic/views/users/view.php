<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\MainAsset;


/* @var yii\web\View $this */
/* @var \app\models\forms\AddPhotos $photosModel */
/* @var app\models\entities\Yiiusers|app\models\forms\RegistrationForm $model
 */

$this->title = $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yiiusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//\yii\web\YiiAsset::register($this);
$this->registerAssetBundle(MainAsset::class);


?>
<div class="yiiusers-view">
    <h1> User: <?= Html::encode($this->title) ?></h1>
    <h3>Main Info</h3>

    <p>
        <?php if (Yii::$app->user->id == $model->id): ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>

        <?php if (Yii::$app->user->can('delete')): ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
    //            'id',
            'username:email',
            'name',
            'surname',
    //            'password',
            'is_active',
    //            'created_at',
    //            'updated_at',
        ],
    ]) ?>
</div>

<?php
echo Html::beginForm(['/users/index'], 'post')
    . Html::submitButton(Yii::t('app', 'Back'), ['class' => 'btn btn-primary'])
    . Html::endForm()
?>

