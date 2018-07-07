<?php

/**
 * @var $this yii\web\View
 * @var $name string
 * @var $message string
 * @var $exception Exception
 */

$this->title = $name.' - '.app()->name;
?>
<h1><?= h($name) ?></h1>
<?= nl2br(h($message)) ?>
