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

use app\models\TrackBlacklist;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;

class TrackBlacklistController extends Controller
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
        ];
    }

    /**
     * @return string|Response
     */
    public function actionIndex()
    {
        $model = new TrackBlacklist;

        if ($model->load(request()->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'data' => TrackBlacklist::all(),
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDelete(int $id): Response
    {
        $model = TrackBlacklist::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        $model->delete();

        return $this->redirect(['index']);
    }
}
