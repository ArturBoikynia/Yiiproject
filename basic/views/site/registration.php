<?php

use yii\web\View;
use app\models\forms\RegistrationForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

use yii\imagine\Image;
/**
 * @var View $this
 * @var RegistrationForm $model
 */

?>
<?php

/*$img = Yii::getAlias('@webroot/images/favicon.ico');
$image = Image::getImagine()->open($img);*/

?>



<h2 class="form-signin-heading text-center"><?=$this->title?></h2>

<?php $form = ActiveForm::begin(['method' => 'post', 'options'=>['class' => ['form-signin']]]) ?>

    <?= $form->field($model, 'username')
        ->textInput()
        ->input('email', ['placeholder' => "Enter Your Email"])
        ->label(false)
    ?>
    <?= $form->field($model, 'name')
        ->textInput()
        ->input('name', ['placeholder' => "Enter Your Name"])
        ->label(false)
    ?>
    <?= $form->field($model, 'surname')
        ->textInput()
        ->input('surname', ['placeholder' => "Enter Your Surname"])
        ->label(false)?>
    <?= $form->field($model, 'password')
        ->passwordInput()
        ->input('password', ['placeholder' => "Enter Your Password"])
        ->label(false)?>
    <?= $form->field($model, 'repeatPassword')
        ->passwordInput()
        ->input('password', ['placeholder' => "Repeat Your Password"])
        ->label(false)?>
    <?= Html::submitButton('Registration', ['class' => 'btn btn-lg btn-primary btn-block'])?>

    <?= Html::a('To Login', ['site/login'], ['class' => ' btn btn-lg btn-primary btn-block ']);?>

<?php ActiveForm::end() ?>


