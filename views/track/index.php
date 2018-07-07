<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 * @var array $stations
 */

$this->title = app()->name;
?>
<div class="now-playing font-weight-bold" data-url="<?= url(['now-playing']) ?>">
    Now Playing: ...
</div>
<span class="now-playing-clip-status small text-muted"></span>
<hr>
<div class="my-3">
    <span class="badge">Stations:</span>
    <a class="badge badge-light" href="<?= url(['index']) ?>">All</a>
    <?php foreach ($stations as $station): ?>
        <a class="badge badge-light" href="<?= url(['index', 'station' => $station]) ?>"><?= h($station) ?></a>
    <?php endforeach ?>
</div>
<div class="track">
    <?php foreach ($data->models as $track): ?>
        <span class="track-title font-weight-bold" data-clipboard-text="<?= $track->title ?>" data-toggle="tooltip"><?= h($track->title) ?></span>
        <a href="<?= url(['index', 'station' => $track->station]) ?>" class="badge badge-light"><?= h($track->station) ?></a>
        <a href="<?= url(['delete', 'id' => $track->id]) ?>" class="badge badge-light" data-method="post">Delete</a>
        <br>
    <?php endforeach ?>
</div>
<?= $this->render('/common/js/clipboard', ['selector' => '.track-title']) ?>
<?php
$this->registerJs(<<<'NOW_PLAYING'
var nowPlaying = function () {
    var $nowPlaying = $('.now-playing')
    
    $.ajax({
        url: $nowPlaying.attr('data-url')
    }).done(function (data) {
        $nowPlaying.html(data)
    }).fail(function () {
        $nowPlaying.html('Request failure')
    })
}

setTimeout(function () {
    setInterval(nowPlaying, 10000)
    nowPlaying()
})
NOW_PLAYING
);
