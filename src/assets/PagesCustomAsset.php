<?php

namespace modava\pages\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class PagesCustomAsset extends AssetBundle
{
    public $sourcePath = '@pagesweb';
    public $css = [
        'css/customPages.css',
    ];
    public $js = [
        'js/customPages.js'
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
