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
    /**
     * @return TrackQuery
     */
    public function latest(): TrackQuery
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }

    /**
     * @param string|null $station
     * @return TrackQuery
     */
    public function station(?string $station): TrackQuery
    {
        return $this->andFilterWhere(['station' => $station]);
    }

    /**
     * @param string|null $title
     * @return TrackQuery
     */
    public function title(?string $title): TrackQuery
    {
        return $this->andFilterWhere(['like', 'title', trim($title)])
            ->orderBy(['title' => SORT_ASC]);
    }
}
