<?php


use yii\web\View;
use yii\helpers\Html;
use app\assets\MainAsset;
use \yii\bootstrap\Nav;
use app\widgets\Language;
use app\models\entities\Yiiusers;
use app\components\EditPhoto;

/**
 * @var string $content
 * @var Yiiusers $model
 */

$this->registerAssetBundle(MainAsset::class);

?>

<?php $this->beginPage() ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <?php $this->head() ?>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/dashboard/">
        <style>
            html, body {
                height: 100%;
                background: white;
            }
        </style>
        <?php $this->registerCsrfMetaTags() ?>
        <?= $title = Html::encode($this->title) ?>
        <title><?= Yii::t('app', $title) ?></title>

    </head>

    <body>
    <?php $this->beginBody() ?>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>"><?= Yii::$app->name ?></a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <?php
                echo Nav::widget([
                    'options' => ['class' => 'nav navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Search Users', 'url' => ['/users/index']],
                        ['label' => 'About', 'url' => ['/site/about']],
                        ['label' => 'Contact', 'url' => ['/site/contact']],
                        Html::tag('li', \app\widgets\Acess::widget()),
                        Yii::$app->user->isGuest ? (
                        ['label' => 'Login', 'url' => ['/site/login']]
                        ) :
                            (
                                '<li>'
                                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form navbar-right'])
                                . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->surname . ')',
                                    ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>'
                            ),
                    ],
                ]);
                ?>
                <?= Html::tag('li', Language::widget(), ['class' => 'navbar-form navbar-right']) ?>
            </div>
        </div>
    </div>

    <?php if (!Yii::$app->user->isGuest): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <div>
                        <?php $image = EditPhoto::findMainPhoto(Yii::$app->user->identity->id); ?>
                        <?php if (!$image): ?>
                            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="140" height="140" class="img-circle" alt="Generic placeholder thumbnail">
                        <?php else:?>
                            <?= Html::img(
                                ['users/image', 'url' => $image->path],
                                [ 'width' => '140', 'height' => '140', 'class' => 'img-circle']) ?>
                        <?php endif; ?>
                        <h4><?php echo Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->surname ?></h4>
                        <span class="text-muted">Something else</span>
                    </div>

                    <?php
                    echo Nav::widget([
                        'options' => ['class' => 'nav nav-sidebar'],
                        'items' => [
                            //                          ['label' => 'Home', 'url' => ['/site/registration']],
                            ['label' => 'About', 'url' => ['/users/view?id=' . Yii::$app->user->identity->id]],
                            ['label' => 'Programming languages', 'url' => ['programminglanguages/view?id=' . Yii::$app->user->identity->id]],
                            ['label' => 'My Gallery', 'url' => ['/users/gallery?id=' . Yii::$app->user->identity->id]],
                            //                          ['label' => 'Contact', 'url' => ['/site/contact']],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <div class="container">
        <?= $content ?>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>