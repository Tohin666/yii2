<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\tables\Tasks */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<? //= DetailView::widget([
//    'model' => $model,
//    'attributes' => [
//        'id',
//        'title',
//        'date',
//        'description:ntext',
//        'responsible_id',
//    ],
//]) ?>



<?php
// кэшируем этот фрагмент. Фрагменты кэшируются во вьюхе
// к ключу теперь в окончание добавляются вариации
$key = 'task';
// в условии открываем кэш, а в теле условия помещаем вьюху и закрываем кэш
if ($this->beginCache($key, [
        'duration' => 200,
        // сюда можно поставить параметр или выражение, при котором кэш отключается
        'enabled' => true,
        // в зависимости от  модели таска и языка сайта меняется ключ
        'variations' => [$model->id, Yii::$app->language],

])) {
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'date',
            'description:ntext',
            'responsible_id',
            'status',
        ],
    ]);
    $this->endCache();
}
?>