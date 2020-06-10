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

use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $station
 * @property string $title
 * @property int $created_at
 *
 * @property string[] $stations
 */
class Track extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'track';
    }

    /**
     * @return TrackQuery
     */
    public static function find(): TrackQuery
    {
        return new TrackQuery(static::class);
    }

    /**
     * @param null|string $station
     * @param null|string $title
     * @return ActiveDataProvider
     */
    public static function all(?string $station = null, ?string $title = null): ActiveDataProvider
    {
        $query = static::find();

        if (null !== $station) {
            $query->station($station);
        }

        if (null === $title) {
            $query->latest();
        } else {
            $query->title($title)
                ->inTitleOrder();
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
    }

    /**
     * @return array
     */
    public static function getStations(): array
    {
        return static::find()
            ->select('station')
            ->distinct()
            ->orderBy(['station' => SORT_DESC])
            ->column();
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'station' => 'Station',
            'title' => 'Title',
            'created_at' => 'Created',
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['station', 'title'], 'required'],
            [['station', 'title'], 'trim'],
            ['title', 'unique', 'message' => 'The track has already been taken.'],
            ['title', 'validateBlocklistTitles'],
        ];
    }

    /**
     * @param string $attribute
     * @return void
     */
    public function validateBlocklistTitles(string $attribute): void
    {
        if (in_array($this->$attribute, TrackBlocklist::getTitles(), true)) {
            $this->addError($attribute, 'That title is included in the blocklist.');
        }
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
            ],
        ];
    }
}
