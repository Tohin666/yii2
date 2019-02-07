<?php
/* @var $model \common\models\tables\Tasks */
/* @var $statusesList \common\models\tables\TaskStatuses[] */
/* @var $usersList \common\models\User[] */
/* @var $userId integer */
/* @var $taskCommentForm \common\models\tables\Comments */

/* @var $taskAttachmentsForm \frontend\models\forms\TaskAttachmentsAddForm */

/* @var $this \yii\web\View */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

\frontend\assets\TaskViewAsset::register($this);
?>

<div class="task-container col-md-9">
    <div class="bg-info task-preview taskView">
        <button id="alert-button">Alert</button>
        <?php
        // прописываем экшн сейв, чтобы при сохранении перенаправлялось на него
        $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $model->id])])
        ?>
        <h2><?= $form->field($model, 'title') ?></h2><br>
        <p><?= $form->field($model, 'description')->textarea() ?></p><br>
        <h3><?= $form->field($model, 'date')
//                ->textInput(['type' => 'date'])
                ->widget(\yii\jui\DatePicker::class, [
                    'language' => 'ru',
                    'clientOptions' => [
                        'dateFormat' => 'yy-mm-dd',
                    ],
                ])
            ?></h3>
        <h4><?= $form->field($model, 'responsible_id')->dropDownList($usersList) ?></h4><br>
        <h4><?= $form->field($model, 'status')->dropDownList($statusesList) ?></h4><br>
        <?= Html::submitButton("Save", ['class' => 'btn btn-success']) ?>
<!--        --><?//= Html::submitButton(Yii::t("main", "Save"), ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end() ?>
        <hr>


        <h3>Вложения</h3>
        <?php
        // Пользователь юзер не может добавлять влжения
        if (!\Yii::$app->user->can('user')) :
            $form = ActiveForm::begin(['action' => Url::to(['add-attachment'])])
            ?>
            <?= $form->field($taskAttachmentsForm, 'taskId')->hiddenInput(['value' => $model->id])
            ->label(false) ?>
            <?= $form->field($taskAttachmentsForm, 'file')->fileInput(); ?>
            <?= Html::submitButton("Добавить", ['class' => 'btn btn-default']) ?>
            <?php
            ActiveForm::end();
        endif;
        ?><br>

        <?php foreach ($model->taskAttachments as $file): ?>
            <?= Html::a(
                Html::img(Url::to(
                    "@web/img/tasks/small/" . $file->path, true)),
                Url::to("@web/img/tasks/" . $file->path, true)
            ) ?>
        <?php endforeach; ?>
        <hr>


        <?php
        // Пользователь юзер не может добавлять коментарии
        if (!\Yii::$app->user->can('user')) :
            $form = ActiveForm::begin(['action' => Url::to(['add-comment'])])
            ?>
            <?= $form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false) ?>
            <?= $form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])
            ->label(false) ?>
            <?= $form->field($taskCommentForm, 'comment')->textarea()
            ->label("Add Comment") ?>
<!--            ->label(Yii::t('main', "TaskAddComment")) ?>-->
            <?= $form->field($taskCommentForm, 'photo')->fileInput(); ?>
            <?= Html::submitButton("Add Comment", ['class' => 'btn btn-default']) ?>
<!--            --><?//= Html::submitButton(Yii::t("main", "TaskAddComment"), ['class' => 'btn btn-default']) ?>
            <?php
            ActiveForm::end();
        endif;
        ?>
        <hr>

        <h3>Comments</h3><br>
<!--        <h3>--><?//= Yii::t("main", "TaskComments") ?><!--</h3><br>-->
        <?php foreach ($model->comments as $comment): ?>
            <p>
                <strong><?= $comment->user->username ?></strong> <i><?= $comment->created_at ?></i><br>
                <?= $comment->comment ?><br>
                <?php if ($comment->photo): ?>
                    <?= Html::a(
                        Html::img(Url::to(
                            "@web/img/small/" . $comment->photo, true)),
                        Url::to("@web/img/" . $comment->photo, true)
                    ) ?>
                <?php endif; ?>
            </p><br>
        <?php endforeach; ?>
        <br>
        <!--        <p>-->
        <!--            --><? //= Html::a(Yii::t("main", "TaskAddComment"),
        //                ['add-comment', 'id' => $model->id], ['class' => 'btn btn-success'])
        ?>
        <!--        </p>-->

    </div>

</div>


