<?php
/* @var $model \common\models\tables\Tasks */

/* @var $this \yii\web\View */

\frontend\assets\TaskWidgetAsset::register($this);
?>

<div class="task-container col-md-4">
        <a href="<?= \yii\helpers\Url::toRoute(['task/view', 'id' => $model->id]) ?>">
        <div class="bg-info task-preview taskWidget">
            <h2>Задача:<br><?= $model->title ?></h2>
            <p>Описание: <?= $model->description ?></p>
            <h3>Дата: <?= $model->date ?></h3>

            <h4>Ответственный: <?= $model->users->username ?></h4>
        </div>
    </a>
</div>


