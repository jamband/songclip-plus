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
use app\models\TrackBlacklist;
use app\tests\DatabaseSeeder;
use app\tests\TestCase;

class TrackTest extends TestCase
{
    protected function setUp(): void
    {
        db()->createCommand()->createTable('track', [
            'id' => 'INTEGER PRIMARY KEY',
            'station' => 'TEXT NOT NULL',
            'title' => 'TEXT NOT NULL',
            'created_at' => 'INTEGER NOT NULL',
        ])->execute();

        db()->createCommand()->createTable('track_blacklist', [
            'id' => 'INTEGER PRIMARY KEY',
            'title' => 'TEXT NOT NULL',
        ])->execute();
    }

    public function testGetStations(): void
    {
        new TrackGetStationsSeeder;

        $this->assertSame(3, count(Track::getStations()));
    }

    public function testBeforeSave(): void
    {
        $track = new Track;
        $track->station = 'station1';
        $track->title = 'title1';
        $track->save();

        $this->assertSame(time(), $track->created_at);
    }

    public function testValidateBlacklistTitles(): void
    {
        new TrackValidateBlacklistTitlesSeeder;

        $track = new Track;
        $track->station = 'station1';
        $track->title = TrackBlacklist::getTitles()[0];
        $track->save();

        $this->assertTrue($track->hasErrors());
        $this->assertSame(1, count($track->getErrors('title')));

    }
}

class TrackGetStationsSeeder
{
    public function __construct()
    {
        new DatabaseSeeder('track', [
            ['station1', 'title1', time()],
            ['station2', 'title2', time()],
            ['station1', 'title3', time()],
            ['station2', 'title4', time()],
            ['station3', 'title5', time()],
        ]);
    }
}

class TrackValidateBlacklistTitlesSeeder
{
    public function __construct()
    {
        new DatabaseSeeder('track_blacklist', [
            ['Super Charisma Radio'],
        ]);
    }
}
