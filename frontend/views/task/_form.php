<?php
/* @var $model \common\models\tables\Tasks */
/* @var $statusesList \common\models\tables\TaskStatuses[] */
/* @var $usersList \common\models\User[] */
/* @var $project \common\models\tables\TaskProjects */

use yii\widgets\ActiveForm;
use yii\helpers\{Url, Html};

// Юзеры могут только просматривать задачи.
if (!\Yii::$app->user->can('TaskEdit')) : ?>
    <h2>Задача:<br><?= $model->title ?></h2>
    <p>Описание: <?= $model->description ?></p>
    <h3>Дата: <?= $model->date ?></h3>
    <h4>Ответственный: <?= $model->users->username ?></h4>
    <h4>Статус: <?= $model->statusName->name ?></h4>

<?php else: ?>
    <?php
    \yii\widgets\Pjax::begin();
    // прописываем экшн сейв, чтобы при сохранении перенаправлялось на него
    $form = ActiveForm::begin([
        'action' => Url::to(['task/save', 'id' => $model->id]),
        'options' => [
            'data' => ['pjax' => true]
        ],
    ])
    ?>
    <?= $form->field($model, 'project_id')->hiddenInput(['value' => $project->id])->label(false) ?>
    <h2><?= $form->field($model, 'title') ?></h2><br>
    <p><?= $form->field($model, 'description')->textarea() ?></p><br>
    <h3><?= $form->field($model, 'date')
////                ->textInput(['type' => 'date'])
//                ->widget(\yii\jui\DatePicker::class, [
//                    'language' => 'ru',
//                    'dateFormat' => 'yy-mm-dd',
//                    'clientOptions' => [
//                        'dateFormat' => 'yy-mm-dd',
//                    ],
//                ])
            ->widget(\kartik\datetime\DateTimePicker::class, [
                'pluginOptions' => [
//                        'format' => 'd-M-Y g:i A',
                ]
            ])
        ?></h3>
    <h4><?= $form->field($model, 'responsible_id')->dropDownList($usersList) ?></h4><br>
    <h4><?= $form->field($model, 'administrator_id')->dropDownList($usersList) ?></h4><br>
    <h4><?= $form->field($model, 'status')->dropDownList($statusesList) ?></h4><br>
    <?= Html::submitButton("Save", ['class' => 'btn btn-success']) ?>
    <!--        --><? //= Html::submitButton(Yii::t("main", "Save"), ['class' => 'btn btn-success']) ?>
    <?php
    ActiveForm::end();
    \yii\widgets\Pjax::end();
    ?>

<?php endif; ?>

<?php if ($model->created_at) : ?><h4>Дата постановки: <?= $model->created_at ?></h4><?php endif; ?>
<?php if ($model->status == 3) : ?><h4>Дата выполнения: <?= $model->updated_at ?></h4><?php endif; ?>
