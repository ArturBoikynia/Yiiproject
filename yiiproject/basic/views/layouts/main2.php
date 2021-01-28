<?php
use yii\web\View;
use app\assets\AppAsset;
use yii\helpers\Html;
use app\assets\MainAsset;
use \yii\bootstrap\NavBar;
use \yii\bootstrap\Nav;
use app\controllers\UsersController;
use app\widgets\Language;
use app\components\getCurrentUser;
use app\components\EditPhoto;
use app\components\web\checkFriendship;


/**
 * @var $this View
 * @var $content string
 * @var $usersModel \app\models\entities\Yiiusers;
 *
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
        <?=$title = Html::encode($this->title) ?>
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
                                    ['class' => 'btn btn-link logout col-ld-10']
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <div class="placeholder">
                    <?php $image = EditPhoto::findMainPhoto(getCurrentUser::$usersModel->id); ?>
                    <?php if (!$image): ?>
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="100" height="100" class="img-responsive" alt="Generic placeholder thumbnail">
                    <?php else:?>
                        <?= Html::img(['users/image', 'url' => $image->path], [ 'width' => '100','height' => '100']) ?>
                    <?php endif; ?>
                    <h4><?php echo getCurrentUser::$usersModel->name . ' ' . getCurrentUser::$usersModel->surname ?></h4>

                    <?php switch(getCurrentUser::$usersModel->is_active == true):
                        case true: ?>
                            <div>
                                <span class="text-danger">Online</span>
                            </div>
                        <?php break; ?>
                        <?php case false: ?>
                            <div>
                                <span class="text-capitalize">Offline</span>
                            </div>
                         <?php break; ?>
                    <?php endswitch; ?>
                    <?php if(!Yii::$app->user->isGuest):?>
                        <?php if(!checkFriendship::isFriends(Yii::$app->user->identity->id, getCurrentUser::$usersModel->id)):?>
                            <?php if(!checkFriendship::check(Yii::$app->user->identity->id, getCurrentUser::$usersModel->id)):?>
                                <?= Html::a(
                                    Yii::t('app', 'Add as Friend'),
                                    ['/users/add-friend', 'user_ask_id' => Yii::$app->user->identity->id , 'user_answer_id' => getCurrentUser::$usersModel->id, 'ask' => 1],
                                    ['class' => 'btn btn-primary',
                                        'data' => [
                                            'method' => 'post',
                                        ],
                                    ]); ?>
                            <?php endif;?>
                        <?php else:?>
                            <?= Html::a(Yii::t('app', 'Remove friend'), ['/users/remove-friend', 'friendId'=> getCurrentUser::$usersModel->id, 'userId' => Yii::$app->user->identity->id ], ['class' => 'btn btn-primary']); ?>
                        <?php endif;?>
                    <?php endif;?>

                    <?php
                    echo Nav::widget([
                        'options' => ['class' => 'nav nav-sidebar'],
                        'items' => [
                            ['label' => 'Friends', 'url' => ['/users/friends?id=' . getCurrentUser::$usersModel->id]],
                            ['label' => 'Main Information', 'url' => ['/users/view?id=' . getCurrentUser::$usersModel->id]],
                            ['label' => 'Education', 'url' => ['users/education?id=' . getCurrentUser::$usersModel->id]],
                            ['label' => 'Programming languages', 'url' => ['programminglanguages/view?id=' . getCurrentUser::$usersModel->id]],
                            ['label' => 'Skills', 'url' => ['/users/skills?id=' . getCurrentUser::$usersModel->id]],
                            ['label' => 'Experience', 'url' => ['/users/experience?id=' . getCurrentUser::$usersModel->id]],
                            ['label' => 'Gallery', 'url' => ['/users/gallery?id=' . getCurrentUser::$usersModel->id]],

                        ],
                    ]);
                    ?>
            </div>
        </div>
    </div>


    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <?= $content  ?>
    </div>


    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>