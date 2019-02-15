<?php
/* @var $model \common\models\tables\Tasks */
/* @var $taskAttachmentsForm \frontend\models\forms\TaskAttachmentsAddForm */

use yii\widgets\ActiveForm;
use yii\helpers\{Url, Html};

\yii\widgets\Pjax::begin([
        'enablePushState' => false,
        'id' => 'task_attachments',
]);
// Пользователь юзер не может добавлять влжения
if (\Yii::$app->user->can('TaskEdit')) :
    $form = ActiveForm::begin([
        'action' => Url::to(['add-attachment']),
        'options' => [
            'data' => ['pjax' => true]
        ],
    ])
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
<?php
endforeach;
\yii\widgets\Pjax::end();
?>