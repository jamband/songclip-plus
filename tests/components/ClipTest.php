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

namespace app\tests\components;

use app\components\Clip;
use PHPUnit\Framework\TestCase;

class ClipTest extends TestCase
{
    protected function setUp(): void
    {
        app()->set('clip', CLip::class);
    }

    public function testExecute() :void
    {
        app()->clip->commandPath = '@app/tests/components/clip-failure';
        $this->assertSame([], app()->clip->track);

        app()->clip->execute();
        $this->assertSame([], app()->clip->track);

        app()->clip->commandPath = '@app/tests/components/clip-success';
        $this->assertSame([], app()->clip->track);

        app()->clip->execute();
        $this->assertSame(['station1', 'title1'], app()->clip->track);
    }

    public function testHasTrack(): void
    {
        app()->clip->commandPath = '@app/tests/components/clip-failure';
        $this->assertFalse(app()->clip->hasTrack());

        app()->clip->execute();
        $this->assertFalse(app()->clip->hasTrack());

        app()->clip->commandPath = '@app/tests/components/clip-success';
        $this->assertFalse(app()->clip->hasTrack());

        app()->clip->execute();
        $this->assertTrue(app()->clip->hasTrack());
    }
}
