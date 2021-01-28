<?php
use yii\helpers\Html;
use app\assets\MainAsset;
use kartik\icons\Icon;
use kartik\form\ActiveForm;
use app\widgets\SkillsView;



/* @var yii\web\View $this */
/* @var app\models\entities\Yiiusers|app\models\forms\RegistrationForm $model */
/* @var app\models\forms\AddSkill $skillsModel */

$this->title = $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yiiusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//\yii\web\YiiAsset::register($this);
$this->registerAssetBundle(MainAsset::class);
Icon::map($this);

?>
<h1> Skills of <?= $model->name . ' ' .   $model->surname?></h1>
<?php if(Yii::$app->user->identity->id === $model->id):?>
    <?php
    $form = ActiveForm::begin([
        'method' => 'post',
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-3']]
    ]);

    ?>

    <?= $form->field($skillsModel, 'addYourSkill')->input('text', ['placeholder' => "Enter Your Email"]) ?>
    <?= Html::submitButton(Icon::show('check-circle ', ['class' => 'fa-2x', 'style' => 'color:Red', 'framework' => Icon::FAS]), ['class' => 'btn btn-link']) ?>

    <?php ActiveForm::end(); ?>
<?php endif; ?>

<?=
SkillsView::widget([
    'viewObject' => $this,
    'model' => $skillsModel,
    'userModel' => $model,
])
?>

<?php //$model1 = \app\models\entities\Yiiusers::find()->where(['id' => $model->id])->one(); ?>

<?php echo \yii2mod\comments\widgets\Comment::widget([
    'model' => $model,
]); ?>







