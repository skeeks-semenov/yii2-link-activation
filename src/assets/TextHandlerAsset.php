<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\linkActivation\assets;

use skeeks\sx\assets\Core;
use yii\web\AssetBundle;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class TextHandlerAsset extends AssetBundle
{
    public $sourcePath = '@skeeks/yii2/linkActivation/assets/src';

    public $css = [];
    public $js = [
        'js/linkActivation.js',
    ];
    public $depends = [
        Core::class,
    ];
}