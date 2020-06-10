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

use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $title
 *
 * @property string[] $titles
 */
class TrackBlocklist extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'track_blocklist';
    }

    /**
     * @return TrackBlocklistQuery
     */
    public static function find(): TrackBlocklistQuery
    {
        return new TrackBlocklistQuery(static::class);
    }

    /**
     * @return ActiveDataProvider
     */
    public static function all(): ActiveDataProvider
    {
        $query = static::find();

        return new ActiveDataProvider([
            'query' => $query->latest('id'),
            'pagination' => false,
        ]);
    }

    /**
     * @return array
     */
    public static function getTitles(): array
    {
        return static::find()
            ->select('title')
            ->orderBy(['title' => SORT_ASC])
            ->column();
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'title' => 'Title',
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['title', 'required'],
            ['title', 'trim'],
            ['title', 'string', 'max' => 100],
            ['title', 'unique'],
        ];
    }
}
