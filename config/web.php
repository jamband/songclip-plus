<?php

/*
 * This file is part of the songclip-plus
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$config = [
    'id' => 'songclip-plus-web',
    'defaultRoute' => 'track/index',
    'components' => [
        'request' => [
            'cookieValidationKey' => $_SERVER['COOKIE_VALIDATION_KEY'],
        ],
        'user' => [
            'identityClass' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                '<controller:(track|track-blocklist)>s' => '<controller>/index',
                '<controller:(track|track-blocklist)>/delete/<id:\d+>' => '<controller>/delete',
                '<controller:(track|track-blocklist)>/<action:(create|now-playing|clip)>' => '<controller>/<action>',
                '' => 'track/index',
            ],
        ],
    ],
    'container' => [
        'definitions' => [
            yii\widgets\ActiveForm::class => [
                'enableClientScript' => false,
                'errorCssClass' => 'is-invalid',
                'successCssClass' => 'is-valid',
                'validationStateOn' => yii\widgets\ActiveForm::VALIDATION_STATE_ON_INPUT,
            ],
            yii\widgets\ActiveField::class => [
                'errorOptions' => ['class' => 'invalid-feedback'],
            ],
        ]
    ]
];

return yii\helpers\ArrayHelper::merge(require __DIR__.'/common.php', $config);
