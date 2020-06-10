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

namespace app\commands;

use app\models\TrackBlacklist;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Manages TrackBlocklist model.
 */
class TrackBlocklistController extends Controller
{
    /**
     * Lists all blocklist of track.
     *
     * @return int
     */
    public function actionIndex(): int
    {
        foreach (TrackBlocklist::find()->latest()->all() as $model) {
            $this->stdout("$model->id $model->title\n");
        }

        return ExitCode::OK;
    }

    /**
     * Creates a new blocklist for track.
     *
     * @param string $title
     * @return int
     */
    public function actionCreate(string $title): int
    {
        $model = new TrackBlocklist;
        $model->title = $title;

        if ($model->save()) {
            $this->stdout("New blocklist has been created.\n");
        } else {
            $this->stderr($model->getFirstError('title')."\n");
        }

        return ExitCode::OK;
    }

    /**
     * Deletes an existing TrackBlocklist model.
     *
     * @param string $id
     * @return int
     */
    public function actionDelete(string $id): int
    {
        $model = TrackBlocklist::findOne($id);

        if (null !== $model) {
            $model->delete();

            $this->stdout("Deleted: $model->title\n");

            return ExitCode::OK;
        }

        $this->stderr("The blocklist not found.\n");

        return ExitCode::UNSPECIFIED_ERROR;
    }
}
