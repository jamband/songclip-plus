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

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $station
 * @property string $title
 * @property int $created_at
 *
 * @property array $stations
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
            ['title', 'validateBlacklistTitles'],
        ];
    }

    /**
     * @param string $attribute
     * @return void
     */
    public function validateBlacklistTitles(string $attribute): void
    {
        if (in_array($this->$attribute, TrackBlacklist::getTitles(), true)) {
            $this->addError($attribute, 'That title is included in the blacklist.');
        }
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->created_at = time();
        }

        return true;
    }
}
