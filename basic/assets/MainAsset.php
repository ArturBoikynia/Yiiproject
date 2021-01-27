<?php


namespace app\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;
use yii\bootstrap\BootstrapAsset;
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/callout.css',
        'css/bootstrap.min.css',
        'css/ie10-viewport-bug-workaround.css',
        'css/dashboard.css',
    ];
    public $js = [
        'JS/ie-emulation-modes-warning.js',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
    ];
}