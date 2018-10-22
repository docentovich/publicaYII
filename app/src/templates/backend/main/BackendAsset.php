<?php


namespace app\assets;
use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $sourcePath = '@current_template/assets';
    public $css = [
        'css/main.css',
        'bundle/vendor.css',
    ];
    public $js = [
        'js/main.js',
        'bundle/vendor.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_BEGIN];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}