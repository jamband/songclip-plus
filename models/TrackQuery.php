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
 * @see \app\models\Track
 */
class TrackQuery extends ActiveQuery
{
    use ActiveQueryTrait;

    /**
     * @param null|string $station
     * @return TrackQuery
     */
    public function station(?string $station): TrackQuery
    {
        if (in_array($station, Track::getStations(), true)) {
            return $this->andWhere(['station' => $station]);
        }

        return $this->andWhere(['station' => '']);
    }

    /**
     * @param null|string $title
     * @return TrackQuery
     */
    public function title(?string $title): TrackQuery
    {
        return $this->andFilterWhere(['like', 'title', trim($title)]);
    }

    /**
     * @return TrackQuery
     */
    public function inTitleOrder(): TrackQuery
    {
        return $this->orderBy(['title' => SORT_ASC]);
    }
}
