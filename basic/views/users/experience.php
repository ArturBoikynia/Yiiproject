<?php
use yii\helpers\Html;
use app\assets\MainAsset;
use kartik\icons\Icon;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use app\widgets\ExperienceView;



/* @var yii\web\View $this */
/* @var app\models\entities\Yiiusers|app\models\forms\RegistrationForm $model */
/* @var app\models\entities\ExperienceEntities $experience */
/* @var array $query */
///* @var app\models\forms\AddSkill $skillsModel */

Icon::map($this);

$this->title = $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yiiusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//\yii\web\YiiAsset::register($this);
$this->registerAssetBundle(MainAsset::class);
?>

<h1> Experience of <?= $model->name . ' ' .   $model->surname?></h1>

<?= ExperienceView::widget([
    'modelsArray' => $query,
    'model' => $model,
])?>
<?php if(Yii::$app->user->can('admin') || (Yii::$app->user->identity->id === $model->id)): ?>
    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Add new Experience
    </a>
<?php endif; ?>

<div class="collapse" id="collapseExample">
    <div style="margin-top: 1%">
        <div class="col-lg-5">
            <?php
            $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]);
            ?>
            <?= $form->field($experience, 'company')
                ->textInput()
                ->input('text')
                ->label(Yii::t('app', 'Company'))
            ?>

            <?= $form->field($experience, 'post')
                ->textInput()
                ->input('text')
                ->label(Yii::t('app', 'Post'))
            ?>

            <?= '<label>Termin:</label>';?>

            <?= $form->field($experience, 'from')
                ->widget(DatePicker::class, [
                    'name' => 'from',
                    'value' => null,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
            ?>

            <?= $form->field($experience, 'to_this_day')
                ->checkbox()
                ->label('To present')
            ?>

            <?= $form->field($experience, 'to')
                ->widget(DatePicker::class, [
                    'name' => 'to',
                    'value' => null,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
            ?>

            <?= $form->field($experience, 'areaOfEmployment')
                ->textarea()
                ->label(Yii::t('app', 'Are of Employment'))
            ?>

            <?= $form->field($experience, 'user_id')->input('integer')->hiddenInput()->label(false);?>

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <?= Html::submitButton('Add', ['class' => 'btn btn-primary mr-1']) ?>
                    <?= Html::resetButton('Reset', ['class' => 'btn btn-secondary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

