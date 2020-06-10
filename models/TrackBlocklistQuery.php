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

namespace app\models;

use yii\db\ActiveQuery;

/**
 * @see \app\models\TrackBlocklist
 */
class TrackBlocklistQuery extends ActiveQuery
{
    use ActiveQueryTrait;
}
