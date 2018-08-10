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
use app\tests\TestCase;

class TrackBlacklistTest extends TestCase
{
    protected function setUp(): void
    {
        db()->createCommand()->createTable('track_blacklist', [
            'id' => 'INTEGER PRIMARY KEY',
            'title' => 'TEXT NOT NULL',
        ])->execute();
    }

    public function testGetTitles(): void
    {
        DatabaseSeeder::run('track_blacklist', [
            ['title1'],
            ['title2'],
        ]);

        $titles = TrackBlacklist::getTitles();

        $this->assertSame(2, count($titles));
        $this->assertSame('title1', $titles[0]);
        $this->assertSame('title2', $titles[1]);
    }
}
