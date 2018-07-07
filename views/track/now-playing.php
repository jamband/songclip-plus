<?php

/**
 * @var yii\web\View $this
 * @var string $title
 */

?>
<span class="track-title font-weight-bold" data-clipboard-text="<?= $title ?>" data-toggle="tooltip">Now Playing: <?= h($title) ?></span>
<span class="badge badge-primary now-playing-clip" data-url="<?= url(['clip']) ?>">Clip</span>
<span class="badge badge-primary now-playing-auto-clip" data-url="<?= url(['clip']) ?>">Auto clip</span>
<?= $this->render('/common/js/clipboard', ['selector' => '.track-title']) ?>
<?php
$this->registerJs(<<<'CLIP'
$(document).off('click', '.now-playing-clip')

$(document).on('click', '.now-playing-clip', function () {
    var $this = $(this)
    var $nowPlayingClipStatus = $('.now-playing-clip-status')
    
    $.ajax({
        url: $this.attr('data-url')
    }).done(function (data) {
        $nowPlayingClipStatus.html(data.message)
        
        var closeNowPlayingClipStatus = function () {
            $nowPlayingClipStatus.html('')
        }
        
        setTimeout(closeNowPlayingClipStatus, 1000)
        
        if (data.success) {
            setTimeout("location.reload()", 1000)
        }
    }).fail(function () {
        $nowPlayingClipStatus.html('Request failure.')
    })
})

$(document).on('click', '.now-playing-auto-clip', function () {
    var $this = $(this)
    var $nowPlayingClipStatus = $('.now-playing-clip-status')
    
    var clip = function () {
        $.ajax({
            url: $this.attr('data-url')
        }).done(function (data) {
            $nowPlayingClipStatus.html('Auto clipping...')
        }).fail(function () {
            $nowPlayingClipStatus.html('Request failure.')
        })
    }
    
    setTimeout(function () {
        setInterval(clip, 30000)
        clip()
    })
})
CLIP
);
