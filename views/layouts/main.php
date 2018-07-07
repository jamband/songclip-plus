<?php

/**
 * @var $this yii\web\View
 * @var $content string
 */

use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->registerCsrfMetaTags() ?>
    <title><?= h($this->title) ?></title>
    <link rel="icon" type="image/png" href="<?= asset('favicon.png') ?>">
    <link rel="stylesheet" href="<?= asset('app.css') ?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <nav class="navbar navbar-light bg-light navbar-expand-md mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= app()->homeUrl ?>"><?= h(app()->name) ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item<?= 'track' === app()->controller->id ? ' active' : '' ?>">
                        <a class="nav-link" href="<?= url(['/track/index']) ?>">Tracks</a>
                    </li>
                    <li class="nav-item<?= 'track-blacklist' === app()->controller->id ? ' active' : '' ?>">
                        <a class="nav-link" href="<?= url(['/track-blacklist/index']) ?>">TrackBlacklists</a>
                    </li>
                </ul>
                <?= Html::beginForm(['/track/index'], 'get', ['class' => 'form-inline my-2 my-lg-0']) ?>
                    <?= Html::textInput('title', request()->get('title', ''), ['class' => 'form-control mr-sm-2', 'placeholder' => 'Search title']) ?>
                <?= Html::endForm() ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="https://github.com/jamband/songclip-plus" rel="noopener" target="_blank">GitHub</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?= $content ?>
    </div>
    <script src="<?= asset('app.js') ?>"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
