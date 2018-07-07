<?php

/**
 * @var yii\web\View $this
 * @var string $selector
 */

$this->registerJs(<<<CLIPBOARD
var clipboard = new ClipboardJS('$selector')

$('$selector').tooltip({
    trigger: 'click',
    title: 'Copied!'
})

clipboard.on('success', function (event) {
    var title = $(event.trigger)
    
    title.tooltip('show')
    
    setTimeout(function () {
        title.tooltip('hide')
    }, 500)
})
CLIPBOARD
);
