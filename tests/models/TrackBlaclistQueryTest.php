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

class TrackBlacklistQueryTest extends TestCase
{
    protected function setUp(): void
    {
        db()->createCommand()->createTable('track_blacklist', [
            'id' => 'INTEGER PRIMARY KEY',
            'title' => 'TEXT NOT NULL',
        ])->execute();
    }

    public function testLatest(): void
    {
        DatabaseSeeder::run('track_blacklist', [
            ['title1'],
            ['title2'],
            ['title3'],
        ]);

        $track = TrackBlacklist::find()->latest('id')->all();

        $this->assertSame('title3', $track[0]->title);
        $this->assertSame('title2', $track[1]->title);
        $this->assertSame('title1', $track[2]->title);
    }
}
