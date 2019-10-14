<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 14.10.2019
 * Time: 16:29
 */

namespace backend\assets;

use \yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/font-awesome';
    public $css = [
        'css/font-awesome.min.css',
    ];
}