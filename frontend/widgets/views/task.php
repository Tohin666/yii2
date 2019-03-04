<?php
/* @var $model \common\models\tables\Tasks */

/* @var $this \yii\web\View */

\frontend\assets\TaskWidgetAsset::register($this);

$taskWidgetClass = 'bg-info task-preview taskWidget';
if ($model->status == 3 || $model->status == 6) {
    $taskWidgetClass .= ' taskWidget-grey';
} elseif ($model->date < date('Y-m-d h:m:s')) {
    $taskWidgetClass .= ' taskWidget-red';
}
?>

<div class="task-container col-md-4">
        <a class="taskWidget-hover" href="<?= \yii\helpers\Url::toRoute(['task/view', 'id' => $model->id]) ?>">
        <div class="<?= $taskWidgetClass ?>">
            <h2>Задача:<br><?= $model->title ?></h2>
            <p>Описание: <?= $model->description ?></p>
            <h4>Дата: <?= $model->date ?></h4>

            <h4>Ответственный: <?= $model->users->username ?></h4>
            <h4>Статус: <?= $model->statusName->name ?></h4>
        </div>
    </a>
</div>


