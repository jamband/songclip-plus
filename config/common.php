<?php

/*
 * This file is part of the songclip-plus
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'name' => 'songclip+',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'clip' => [
            'class' => app\components\Clip::class,
        ],
        'cache' => [
            'class' => yii\caching\FileCache::class,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                    'logVars' => ['_GET', '_POST', '_COOKIE', '_SESSION'],
                ],
            ],
        ],
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => $_SERVER['DB_DSN'],
            'charset' => 'utf8',
            'enableSchemaCache' => true,
        ],
    ],
];
