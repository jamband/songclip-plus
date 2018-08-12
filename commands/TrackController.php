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

use app\models\Track;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Manages Track model.
 */
class TrackController extends Controller
{
    /**
     * Lists all tracks.
     *
     * @return int
     */
    public function actionIndex(): int
    {
        foreach (Track::find()->latest()->all() as $model) {
            $this->stdout("$model->id $model->title\n");
        }

        return ExitCode::OK;
    }

    /**
     * Displays a now playing track.
     *
     * @return int
     */
    public function actionNow(): int
    {
        app()->clip->execute();

        if (app()->clip->hasTrack()) {
            list(, $title) = app()->clip->track;

            $this->stdout("Now playing: $title\n");

            return ExitCode::OK;
        }

        return ExitCode::UNSPECIFIED_ERROR;
    }


    /**
     * Clips a track from the current stream.
     *
     * @param string $enableOutput
     * @return int
     */
    public function actionClip(string $enableOutput = 'yes'): int
    {
        app()->clip->execute();

        if (app()->clip->hasTrack()) {
            list($station, $title) = app()->clip->track;

            $model = new Track;
            $model->station = $station;
            $model->title = $title;
            $model->save();

            if ('yes' === $enableOutput) {
                if ($model->hasErrors()) {
                    $this->stderr($model->getFirstError('title')." ($title)\n");
                } else {
                    $this->stdout("Clipped: $title\n");
                }
            }

            return ExitCode::OK;
        }

        return ExitCode::UNSPECIFIED_ERROR;
    }

    /**
     * Clips a track from the current stream automatically.
     *
     * @return void
     */
    public function actionAutoClip(): void
    {
        $this->stdout('Auto Clipping...');

        while (true) {
            $this->runAction('clip', ['no']);
            sleep(30);
        }
    }

    /**
     * Deletes an existing Track model.
     *
     * @param string $id
     * @return int
     */
    public function actionDelete(string $id): int
    {
        $model = Track::findOne($id);

        if (null !== $model) {
            $model->delete();

            $this->stdout("Deleted: $model->title\n");

            return ExitCode::OK;
        }

        $this->stderr("The track not found.\n");

        return ExitCode::UNSPECIFIED_ERROR;
    }

    /**
     * Deletes all track models.
     *
     * @return int
     */
    public function actionPurge(): int
    {
        if ($this->confirm('Are you sure?')) {
            db()->createCommand()
                ->truncateTable(Track::tableName())
                ->execute();

            if ('sqlite' === db()->driverName) {
                db()->createCommand()
                    ->delete('sqlite_sequence', ['name' => Track::tableName()])
                    ->execute();
            }

            $this->stdout("Deleted all tracks.\n");
        }

        return ExitCode::OK;
    }
}
