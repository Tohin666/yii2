<?php
/** @var \yii\web\View $this */
/** @var array $messages */

$script = <<<JS
setInterval(function() {
  $("btn-refresh").click();
}, 1000)
JS;

$this->registerJs($script);
\yii\widgets\Pjax::begin();
?>

<div class="message-container">
    <?php
    echo \yii\helpers\Html::a("Refresh", ["telegram/receive"], ['id' => 'btn-refresh', 'class' => 'btn btn-success']);
    foreach ($messages as $message) : ?>
    <div>
        <strong><?= $message['username'] ?>: </strong>
        <?= $message['text'] ?>
    </div>
    <?php endforeach; ?>
</div>
<?php \yii\widgets\Pjax::end() ?>