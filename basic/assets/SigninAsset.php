<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;
use yii\bootstrap\BootstrapAsset;
class SigninAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/signin.css',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
    ];
}