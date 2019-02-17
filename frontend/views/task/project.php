<?php
/** @var \common\models\tables\TaskProjects $modelProject */

use yii\helpers\Html;

?>

<h1>Проект: <?= $modelProject->name ?></h1>

<?php
// Юзеры могут только просматривать задачи.
if (\Yii::$app->user->can('TaskEdit')) :
    ?>
    <br>
    <p>
        <?= Html::a('Create Tasks', ['view', 'project-id' => $modelProject->id], ['class' => 'btn btn-success']) ?>
    </p>
    <br>
<?php endif; ?>


<?php if ($dataProvider) : ?>

    <?= Html::beginForm(['index']) ?>

    <?= Html::dropDownList('year', 2019, [2017 => 2017, 2018 => 2018, 2019 => 2019]) ?>
    <?= Html::dropDownList('month', 'jan', [
        '01' => 'jan', '02' => 'feb', '03' => 'mar', '04' => 'apr', '05' => 'may', '06' => 'jun',
        '07' => 'jul', '08' => 'aug', '09' => 'sep', '10' => 'oct', '11' => 'nov', '12' => 'dec',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Filter', ['class' => 'btn btn-primary']) ?>
    </div>

    <?= Html::endForm() ?>



    <?= \yii\widgets\ListView::widget([
        // коллекция моделей (тасков)
        'dataProvider' => $dataProvider,
        // каждую модель отдельно передает во вьюху
//    'itemView' => 'view',
        'itemView' => function ($model) { // модель на каждый таск приходит из датапровайдера
            return \frontend\widgets\TaskWidget::widget(['model' => $model]);
        },
        'summary' => false,
//    'options' => [
//            'class' => 'col-md-4'
//    ]

    ]); ?>
<?php endif; ?>




