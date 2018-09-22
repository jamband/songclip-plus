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
use app\tests\TestCase;

class TrackQueryTest extends TestCase
{
    protected function setUp(): void
    {
        db()->createCommand()->createTable('track', [
            'id' => 'INTEGER PRIMARY KEY',
            'station' => 'TEXT NOT NULL',
            'title' => 'TEXT NOT NULL',
            'created_at' => 'INTEGER NOT NULL',
        ])->execute();
    }

    public function testLatest(): void
    {
        DatabaseSeeder::run('track', [
            ['station1', 'title1', time()],
            ['station2', 'title2', time() + 1],
            ['station3', 'title3', time() + 2],
        ]);

        $track = Track::find()->latest()->all();

        $this->assertSame('title3', $track[0]->title);
        $this->assertSame('title2', $track[1]->title);
        $this->assertSame('title1', $track[2]->title);
    }

    public function testStation(): void
    {
        static::commonSeeder();

        $tracks = Track::find()->station('foo')->all();
        $this->assertSame(0, count($tracks));

        $tracks = Track::find()->station('station1')->all();
        $this->assertSame('station1', $tracks[0]->station);
        $this->assertSame(1, count($tracks));
    }

    public function testTitle(): void
    {
        static::commonSeeder();

        $tracks = Track::find()->title('foo')->all();
        $this->assertSame(0, count($tracks));

        $tracks = Track::find()->title('e1')->all();
        $this->assertSame('title1', $tracks[0]->title);
        $this->assertSame(1, count($tracks));
    }

    public function testInTitleOrder(): void
    {
        DatabaseSeeder::run('track', [
            ['station1', 'foo', time()],
            ['station1', 'bar', time()],
            ['station1', 'baz', time()],
        ]);

        $tracks = Track::find()->inTitleOrder()->all();
        $this->assertSame('bar', $tracks[0]->title);
        $this->assertSame('baz', $tracks[1]->title);
        $this->assertSame('foo', $tracks[2]->title);
    }

    private static function commonSeeder(): void
    {
        DatabaseSeeder::run('track', [
            ['station1', 'title1', time()],
            ['station2', 'title2', time()],
        ]);
    }
}
