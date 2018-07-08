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
        $clip = app()->clip;
        $clip->commandPath = '@app/tests/components/clip-failure';
        $this->assertSame([], $clip->track);

        $clip->execute();
        $this->assertSame([], $clip->track);

        $clip->commandPath = '@app/tests/components/clip-success';
        $this->assertSame([], $clip->track);

        $clip->execute();
        $this->assertSame(['station1', 'title1'], $clip->track);
    }

    public function testHasTrack(): void
    {
        $clip = app()->clip;
        $clip->commandPath = '@app/tests/components/clip-failure';
        $this->assertFalse($clip->hasTrack());

        $clip->execute();
        $this->assertFalse($clip->hasTrack());

        $clip->commandPath = '@app/tests/components/clip-success';
        $this->assertFalse($clip->hasTrack());

        $clip->execute();
        $this->assertTrue($clip->hasTrack());
    }
}
