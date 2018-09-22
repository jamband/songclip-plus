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

namespace app\controllers;

use app\models\Track;
use yii\data\ActiveDataProvider;
use yii\filters\AjaxFilter;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;

class TrackController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            [
                'class' => AjaxFilter::class,
                'only' => ['now-playing', 'clip'],
            ]
        ];
    }

    /**
     * @param null|string $station
     * @param null|string $title
     * @return string
     */
    public function actionIndex(?string $station = null, ?string $title = null): string
    {
        return $this->render('index', [
            'data' => Track::all($station, $title),
            'stations' => Track::getStations(),
        ]);
    }

    /**
     * @return string
     */
    public function actionNowPlaying(): string
    {
        app()->clip->execute();

        if (app()->clip->hasTrack()) {
            list($station, $title) = app()->clip->track;

            session()->set('station', $station);
            session()->set('title', $title);

        } elseif (null !== session()->get('station') && null !== session()->get('title')) {
            session()->remove('station');
            session()->remove('title');
        }

        return $this->renderAjax('now-playing', [
            'title' => $title ?? '...',
        ]);
    }

    /**
     * @return Response
     */
    public function actionClip(): Response
    {
        $model = new Track;
        $model->station = session()->get('station');
        $model->title = session()->get('title');

        return $this->asJson([
            'success' => $success = $model->save(),
            'message' => $success ? 'Clipped!' : $model->getFirstError('title'),
        ]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDelete(int $id): Response
    {
        $model = Track::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        $model->delete();

        return $this->redirect(['index']);
    }
}
