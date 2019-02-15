<?php
/* @var $model \common\models\tables\Tasks */
/* @var $statusesList \common\models\tables\TaskStatuses[] */
/* @var $usersList \common\models\User[] */
/* @var $userId integer */
/* @var $taskCommentForm \common\models\tables\Comments */

/* @var $taskAttachmentsForm \frontend\models\forms\TaskAttachmentsAddForm */

/* @var $this \yii\web\View */

/** @var $history \common\models\tables\TaskChat */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

\frontend\assets\TaskViewAsset::register($this);
\frontend\assets\TaskChatViewAsset::register($this);
?>

<div class="task-container col-md-9">
    <div class="bg-info task-preview taskView">

        <?= $this->render('_form', [
            'model' => $model,
            'usersList' => $usersList,
            'statusesList' => $statusesList,
        ]) ?>

        <hr>


        <h3>Вложения</h3>

        <?= $this->render('_attachments', [
            'model' => $model,
            'taskAttachmentsForm' => $taskAttachmentsForm,
        ]) ?>

        <hr>


        <?= $this->render('_comments', [
            'model' => $model,
            'taskCommentForm' => $taskCommentForm,
            'userId' => $userId,
        ]) ?>

        <hr>


        <?php if ($model->id) : ?>

            <h3>Chat</h3><br>

            <!--        <form action="#" name="chat_form" id="task_chat_form" data-userid="--><? //= Yii::$app->user->id ?? "null" ?><!--"-->
            <!--              data-taskid="--><? //= $model->id ?><!--">-->
            <form action="#" name="chat_form" id="task_chat_form">
                <label>
                    <input type="hidden" name="taskid" value="<?= $model->id ?>"/>
                    <input type="hidden" name="userid" value="<?= $userId ?>"/>
                    введите сообщение
                    <input type="text" name="message"/>
                    <input type="submit"/>
                </label>
            </form>
            <hr>
            <div id="root_task_chat">
                <?php foreach ($history as $message) : ?>
                    <?php $username = $message->user->username ?? 'Аноним' ?>
                    <div><?= "<b>" . $username . ":</b> " . $message->message ?></div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </div>
</div>
<script>
    // передаем параметр в скрипт taskChat.js, чтобы привязать чат к каналу (таску)
    var task = <?= $model->id ?>;
</script>

