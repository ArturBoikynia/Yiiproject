<?php

use app\assets\MainAsset;
use kartik\icons\Icon;




/* @var yii\web\View $this */
/* @var app\models\entities\Yiiusers|app\models\forms\RegistrationForm $model */
/* @var app\models\forms\AddSkill $skillsModel */

$this->title = $model->name . ' ' . $model->surname;


$this->registerAssetBundle(MainAsset::class);
Icon::map($this);

?>
<h1> Questions to <?= $model->name . ' ' .   $model->surname?></h1>

<?php echo \yii2mod\comments\widgets\Comment::widget([
    'model' => $model,
]); ?>