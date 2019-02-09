<?php
/** @var $history \common\models\tables\Chat */

\frontend\assets\ChatViewAsset::register($this);
?>

<form action="#" name="chat_form" id="chat_form" data-userid="<?= Yii::$app->user->id ?? "null" ?>">
    <label>
        введите сообщение
        <input type="text" name="message"/>
        <input type="submit"/>
    </label>
</form>
<hr>
<div id="root_chat">
    <?php foreach ($history as $message) : ?>
    <?php $username = $message->user->username ?? 'Аноним' ?>
    <div><?= "<b>" . $username . ":</b> " . $message->message ?></div>
    <?php endforeach; ?>
</div>
<!--<script src="client.js"></script>-->