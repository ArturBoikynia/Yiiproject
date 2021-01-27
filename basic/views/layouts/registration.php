<?php
use yii\web\View;
use app\assets\AppAsset;
use yii\helpers\Html;
use app\assets\SigninAsset;

/**
 * @var $this View
 * @var $content string
 */

$this->registerAssetBundle(SigninAsset::class);

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
    <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/signin/">
      <style>
          html, body {
              height: 100%;
              background: white;
          }
      </style>
    <?php $this->registerCsrfMetaTags() ?>

<!--    <title>Signin Template for Bootstrap</title>-->
    <?=$title = Html::encode($this->title) ?>
    <title><?= Yii::t('app', $title) ?></title>
  </head>

  <body>

  <?php $this->beginBody() ?>

    <div class="container">

      <?= $content ?>

    </div>

    <?php $this->endBody() ?>

  </body>
</html>
<?php $this->endPage() ?>
