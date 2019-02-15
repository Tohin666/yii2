<?php
/* @var $model \common\models\tables\Tasks */
/* @var $taskCommentForm \common\models\tables\Comments */
/* @var $userId integer */

use yii\widgets\ActiveForm;
use yii\helpers\{Url, Html};

\yii\widgets\Pjax::begin([
    'enablePushState' => false,
    // добавляем вручную айдишник, чтобы pjax находил себя, чтобы потом не получилось путаницы
    'id' => 'task_comments',
]);
// Пользователь юзер не может добавлять коментарии
if (\Yii::$app->user->can('TaskEdit')) :
    $form = ActiveForm::begin([
        'action' => Url::to(['add-comment']),
        'options' => [
            'data' => ['pjax' => true]
        ],
    ])
    ?>
    <?= $form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false) ?>
    <?= $form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])
    ->label(false) ?>
    <?= $form->field($taskCommentForm, 'comment')->textarea()
    ->label("Add Comment") ?>
    <!--            ->label(Yii::t('main', "TaskAddComment")) ?>-->
    <!--            --><?//= $form->field($taskCommentForm, 'photo')->fileInput();
    ?>
    <?= Html::submitButton("Add Comment", ['class' => 'btn btn-default']) ?>
    <!--            --><?//= Html::submitButton(Yii::t("main", "TaskAddComment"), ['class' => 'btn btn-default'])
    ?>
    <?php
    ActiveForm::end();
endif;
?>
    <hr>

    <h3>Comments</h3><br>
    <!--        <h3>--><? //= Yii::t("main", "TaskComments") ?><!--</h3><br>-->
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
<?php
endforeach;
\yii\widgets\Pjax::end();
?>