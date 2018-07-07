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

namespace app\components;

use Yii;
use yii\base\BaseObject;

class Clip extends BaseObject
{
    /**
     * @var string
     */
    public $commandPath = '@app/clip';

    /**
     * @var array
     */
    public $track = [];

    /**
     * @return void
     */
    public function execute()
    {
        exec(Yii::getAlias($this->commandPath), $track);

        $this->track = $track;
    }

    /**
     * @return bool
     */
    public function hasTrack(): bool
    {
        return 2 === count($this->track);
    }
}
