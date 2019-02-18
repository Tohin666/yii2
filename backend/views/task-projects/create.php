<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\tables\TaskProjects */

$this->title = 'Create Task Projects';
$this->params['breadcrumbs'][] = ['label' => 'Task Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-projects-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
