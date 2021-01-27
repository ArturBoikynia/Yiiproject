<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\MainAsset;
use yii\bootstrap\Carousel;


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

<style>
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        /*width: 70;*/
        margin: auto;
    }
</style>

<h1> User: <?= $model->name . ' ' .   $model->surname?></h1>
<h1 style="text-align: center; margin: 3%"> Gallery </h1>

<?php foreach ($model->images as $image): ?>
    <?php $arrayImage[] = Html::img(['image', 'url' => $image->path]);  ?>
<?php endforeach;?>

<?php if(empty($arrayImage)):?>
    <?php $arrayImage = []?>
<?php endif;?>

<?=  Carousel::widget([
    'options' => ['class' => 'carousel slide'],
    'items' => $arrayImage,
]);
?>

<?php if (Yii::$app->user->id == $model->id): ?>
    <div style="margin: 1%">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
        <?= $form->field($photosModel, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
        <?= Html::submitButton(Yii::t('app', 'Add Photos')) ?>
        <?php ActiveForm::end() ?>
    </div>

    <?php foreach ($model->images as $image): ?>
        <div class="panel panel-default">
            <div class="panel-heading">Panel heading without title</div>
            <div class="panel-body">
                <?= Html::img(['users/image', 'url' => $image->path], ['class' => 'col-xs-10']) ?>
                <?= $image->is_main ? Html::a(
                    Yii::t('app', 'Remove as Main'),
                    ['remove-main', 'id' => $model->id, 'remove' => true, 'path' => $image->path],
                    ['class' => 'btn btn-default col-xs-2 ',
                        'data' => [
                            'method' => 'post',
                        ],
                    ])
                    :
                    Html::a(
                    Yii::t('app', 'Set as Main'),
                    ['main-photo', 'id' => $model->id, 'set' => true, 'path' => $image->path],
                    ['class' => 'btn btn-default col-xs-2 ',
                        'data' => [
                            'method' => 'post',
                        ],
                    ]); ?>


                <?= Html::a(
                    Yii::t('app', 'Delete'),
                    ['delete-photo', 'id' => $model->id, 'delete' => true, 'path' => $image->path],
                    ['class' => 'btn btn-default col-xs-2 mt-10',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
            </div>
        </div>
    <?php endforeach ?>
<?php endif;?>

