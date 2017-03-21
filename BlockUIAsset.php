<?php
namespace seiweb\ext;

use yii\web\AssetBundle;

class BlockUIAsset extends AssetBundle
{
    public $sourcePath = '@bower/blockui';

    public $js = [
        'jquery.blockUI.js'
    ];

    public $css = [

    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function init()
    {
        parent::init();
    }
} 