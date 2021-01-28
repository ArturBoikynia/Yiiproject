<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use app\assets\MainAsset;
use kartik\form\ActiveForm;

/* @var yii\web\View $this */
/* @var app\models\entities\ExperienceEntities $model
 */

$this->title = $model->user->name . ' ' . $model->user->surname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yiiusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//\yii\web\YiiAsset::register($this);
$this->registerAssetBundle(MainAsset::class);
?>

<h1> User: <?= $model->user->name . ' ' .   $model->user->surname?></h1>

<div class="col-lg-5">
    <?php
    $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>
    <?= $form->field($model, 'company')
        ->textInput()
        ->input('text')
        ->label(Yii::t('app', 'Company'))
    ?>

    <?= $form->field($model, 'post')
        ->textInput()
        ->input('text')
        ->label(Yii::t('app', 'Post'))
    ?>

    <?= '<label>Termin:</label>';?>

    <?= $form->field($model, 'from')
        ->widget(DatePicker::class, [
            'name' => 'from',
            'value' => null,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ])
    ?>

    <?= $form->field($model, 'to_this_day')
        ->checkbox()
        ->label('To present')
    ?>

    <?= $form->field($model, 'to')
        ->widget(DatePicker::class, [
            'name' => 'to',
            'value' => null,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ])
    ?>

    <?= $form->field($model, 'areaOfEmployment')
        ->textarea()
        ->label(Yii::t('app', 'Are of Employment'))
    ?>

    <?= $form->field($model, 'user_id')->input('integer')->hiddenInput()->label(false);?>

    <div class="form-group row">
        <div class="col-sm-3"></div>
        <div class="col-sm-9">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary mr-1']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>