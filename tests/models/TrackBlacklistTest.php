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

namespace app\tests\models;

use app\models\TrackBlacklist;
use app\tests\DatabaseSeeder;
use PHPUnit\Framework\TestCase;
use yii\db\Connection;

class TrackBlacklistTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        app()->set('db', [
            'class' => Connection::class,
            'dsn' => 'sqlite::memory:',
        ]);
    }

    protected function setUp(): void
    {
        db()->createCommand()->createTable('track_blacklist', [
            'id' => 'INTEGER PRIMARY KEY',
            'title' => 'TEXT NOT NULL',
        ])->execute();
    }

    protected function tearDown(): void
    {
        db()->close();
    }

    public function testGetTitles(): void
    {
        new TrackBlacklistGetTitlesSeeder;

        $titles = TrackBlacklist::getTitles();

        $this->assertSame(2, count($titles));
        $this->assertSame('title1', $titles[0]);
        $this->assertSame('title2', $titles[1]);
    }

}

class TrackBlacklistGetTitlesSeeder
{
    public function __construct()
    {
        new DatabaseSeeder('track_blacklist', [
            ['title1'],
            ['title2'],
        ]);
    }
}
