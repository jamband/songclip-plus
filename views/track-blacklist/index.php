<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 * @var app\models\TrackBlacklist $model
 * @var yii\widgets\ActiveForm $form
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Track blacklists - '.app()->name;
?>
<div class="row">
    <div class="col-md-6">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'title')->textInput(['autofocus' => true, 'maxlength' => true, 'placeholder' => 'Please enter blacklist']) ?>
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-md-6">
    </div>
</div>
<hr>
<div class="track-blacklists">
    <?php foreach ($data->models as $blacklist): ?>
        <span class="font-weight-bold"><?= h($blacklist->title) ?></span>
        <a href="<?= url(['delete', 'id' => $blacklist->id]) ?>" class="badge badge-light" data-method="post">Delete</a>
        <br>
    <?php endforeach ?>
</div>
