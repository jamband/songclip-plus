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

use app\models\Track;
use app\tests\DatabaseSeeder;
use PHPUnit\Framework\TestCase;
use yii\db\Connection;

class TrackQueryTest extends TestCase
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
        db()->createCommand()->createTable('track', [
            'id' => 'INTEGER PRIMARY KEY',
            'station' => 'TEXT NOT NULL',
            'title' => 'TEXT NOT NULL',
            'created_at' => 'INTEGER NOT NULL',
        ])->execute();
    }

    protected function tearDown(): void
    {
        db()->close();
    }

    public function testLatest(): void
    {
        new TrackQueryLatestSeeder;

        $track = Track::find()->latest()->all();

        $this->assertSame('title3', $track[0]->title);
        $this->assertSame('title2', $track[1]->title);
        $this->assertSame('title1', $track[2]->title);
    }

    public function testStation(): void
    {
        new TrackQueryCommonSeeder;

        $track = Track::find()->station('station1')->all();

        $this->assertSame('station1', $track[0]->station);
        $this->assertSame(1, count($track));
    }

    public function testTitle(): void
    {
        new TrackQueryCommonSeeder;

        $track = Track::find()->title('e1')->all();

        $this->assertSame('title1', $track[0]->title);
        $this->assertSame(1, count($track));
    }
}

class TrackQueryLatestSeeder
{
    public function __construct()
    {
        new DatabaseSeeder('track', [
            ['station1', 'title1', time()],
            ['station2', 'title2', time() + 1],
            ['station3', 'title3', time() + 2],
        ]);
    }
}

class TrackQueryCommonSeeder
{
    public function __construct()
    {
        new DatabaseSeeder('track', [
            ['station1', 'title1', time()],
            ['station2', 'title2', time()],
        ]);
    }
}
