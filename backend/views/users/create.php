<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\User */

$this->title = 'Create Users';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
//        'roles' => $roles,
    ]) ?>

</div>
