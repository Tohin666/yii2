<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\tables\TaskProjects */

$this->title = 'Update Task Projects: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Task Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-projects-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
