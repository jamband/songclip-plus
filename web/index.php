<?php

/*
 * This file is part of the songclip-plus
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__.'/../vendor/autoload.php';

Dotenv\Dotenv::create(dirname(__DIR__))->load();

require __DIR__.'/../vendor/yiisoft/yii2/Yii.php';

(new yii\web\Application(require __DIR__.'/../config/web.php'))->run();
