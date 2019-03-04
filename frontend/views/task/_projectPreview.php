<?php
/* @var $model \common\models\tables\TaskProjects */

/* @var $this \yii\web\View */

\frontend\assets\TaskWidgetAsset::register($this);
?>

<div class="task-container col-md-4">
        <a href="<?= \yii\helpers\Url::toRoute(['task/project', 'project_id' => $model->id]) ?>">
        <div class="bg-info task-preview taskWidget">
            <h2>Проект:<br><?= $model->name ?></h2>

            <h3>Задачи:</h3>
            <?php foreach ($model->tasks as $task) : ?>
            <h4><?= $task->title ?></h4>
            <?php endforeach; ?>

            <h3>Участники:</h3>
            <?php foreach ($model->tasks as $task) : ?>
                <h4><?= $task->title ?></h4>
            <?php endforeach; ?>
        </div>
    </a>
</div>


