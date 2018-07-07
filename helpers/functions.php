<?php

/*
 * This file is part of the songclip-plus
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

// Core components
if (!function_exists('app')) {
    /**
     * @return WebApplication|ConsoleApplication
     */
    function app() {
        return Yii::$app;
    }
}

if (!function_exists('db')) {
    /**
     * @return yii\db\Connection
     */
    function db(): yii\db\Connection {
        return Yii::$app->getDb();
    }
}

if (!function_exists('formatter')) {
    /**
     * @return yii\i18n\Formatter
     */
    function formatter(): yii\i18n\Formatter {
        return Yii::$app->getFormatter();
    }
}

if (!function_exists('request')) {
    /**
     * @return yii\console\Request|yii\web\Request
     */
    function request() {
        return Yii::$app->getRequest();
    }
}

if (!function_exists('response')) {
    /**
     * @return yii\console\Response|yii\web\Response
     */
    function response() {
        return Yii::$app->getResponse();
    }
}

if (!function_exists('session')) {
    /**
     * @return yii\web\Session
     */
    function session(): yii\web\Session {
        return Yii::$app->getSession();
    }
}

if (!function_exists('security')) {
    /**
     * @return yii\base\Security
     */
    function security() {
        return Yii::$app->getSecurity();
    }
}

// Other
if (!function_exists('url')) {
    /**
     * @param array|string $url
     * @param bool|string $scheme
     * @return string
     */
    function url($url = '', $scheme = false): string {
        return yii\helpers\Url::to($url, $scheme);
    }
}

if (!function_exists('h')) {
    /**
     * @param string $string
     * @return string
     */
    function h(string $string): string {
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('asset')) {
    /**
     * @param string $file
     * @return string
     */
    function asset(string $file): string {
        $manifest = Yii::getAlias('@app/web/assets/manifest.json');

        $manifest = file_exists($manifest)
            ? json_decode(file_get_contents($manifest))
            : new stdClass;

        return property_exists($manifest, $file)
            ? $manifest->$file
            : '/assets/'.$file;
    }
}
