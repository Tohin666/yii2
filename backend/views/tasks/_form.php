<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
/* @var $userList array */
/* @var $statusList array */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::class) ?>
<!--    --><?//= $form->field($model, 'date')->textInput(['value' => '2018-12-22 09:36:03']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'responsible_id')->dropDownList($userList,
        ['prompt' => 'Select Responsible']
    ) ?>

    <?= $form->field($model, 'status')->dropDownList($statusList,
        ['prompt' => 'Select Status']
    ) ?>

    <!--    --><? //= $form->field($model, 'responsible_id')->dropDownList(
    //        \app\models\tables\Users::find()->select(['username', 'id'])->indexBy('id')->column(),
    //        ['prompt' => 'Select Responsible']
    //    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
