<?php

use yii\helpers\Html;

?>

<?php
// Юзеры могут только просматривать проекты.
if (\Yii::$app->user->can('TaskEdit')) :
    ?>
    <?php $form = \yii\widgets\ActiveForm::begin([
    'action' => \yii\helpers\Url::to(['task/project']),
]); ?>
    <?= $form->field($model, 'name') ?>
    <?= Html::submitButton('Create Project', ['class' => 'btn btn-success']) ?>
    <?php \yii\widgets\ActiveForm::end(); ?>
<?php endif; ?>


<? //= \yii\widgets\ListView::widget([
//    // коллекция моделей (тасков)
//    'dataProvider' => $dataProvider,
//    // каждую модель отдельно передает во вьюху
//    'itemView' => 'view',
////    'itemView' => function ($model) { // модель на каждый таск приходит из датапровайдера
////        return \frontend\widgets\TaskWidget::widget(['model' => $model]);
////    },
//    'summary' => false,
////    'options' => [
////            'class' => 'col-md-4'
////    ]
//
//]); ?>





