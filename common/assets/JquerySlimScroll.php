<?php
namespace common\assets;

use yii\web\AssetBundle;

/**
 * Class JquerySlimScroll
 * @package common\assets
 * @author Andrey Avseenko <bropwnz0r@gmail.com>
 */
class JquerySlimScroll extends AssetBundle
{
    public $sourcePath = '@bower/jquery-slimscroll';
    public $js = [
        'jquery.slimscroll.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
