<?php
use yii\helpers\Html;
use app\assets\MainAsset;
use kartik\icons\Icon;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;



/* @var yii\web\View $this */
/* @var app\models\entities\Yiiusers|app\models\forms\RegistrationForm $model */
/* @var array $queryModel */

$this->title = $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yiiusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//\yii\web\YiiAsset::register($this);
$this->registerAssetBundle(MainAsset::class);
Icon::map($this);

?>
    <h1> User: <?= $queryModel->user->name . ' ' .   $queryModel->user->surname?></h1>
    <h4> Update School education</h4>


<div class="row">
    <div class="col-lg-5">
        <?php
        $form = ActiveForm::begin([
            'action' => 'education',
            'id' => 8,
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]);
        ?>
        <?= $form->field($queryModel, 'nameOfSchool')
            ->textInput()
            ->input('text')
            ->label(Yii::t('app', 'School'))
        ?>

        <?= $form->field($queryModel, 'place')
            ->textInput()
            ->input('text')
            ->label(Yii::t('app', 'Place'))
        ?>

        <?= $form->field($queryModel, 'specialty')
            ->textInput()
            ->input('text')
            ->label(Yii::t('app', 'Specialty'))
        ?>
        <?= $form->field($queryModel, 'begin')
            ->widget(DatePicker::class, [
                'name' => 'from',
                'value' => null,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])
        ?>

        <?= $form->field($queryModel, 'to_this_day')
            ->checkbox()
            ->label('To present')
        ?>

        <?= $form->field($queryModel, 'end')
            ->widget(DatePicker::class, [
                'name' => 'to',
                'value' => null,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])
        ?>
        <?=Html::a('Update',
            ['update-education', 'id' => $queryModel->user->id, 'tableName' => $queryModel::tableName()],
            [
                'class' => 'btn btn-primary',
                'data' => [
                    'method' => 'post',
                ]
            ])?>
        <?php ActiveForm::end();?>
    </div>
</div>

