<?php ?>

<div>
    <?php
    $form = \yii\widgets\ActiveForm::begin();
    echo $form->field($model, 'task_id')->label(false)->hiddenInput(['value' => $taskId]);
    echo $form->field($model, 'comment')->textarea();
    echo $form->field($model, 'photo')->fileInput();
    echo \yii\helpers\Html::submitButton('Send');
    \yii\widgets\ActiveForm::end();
    ?>

</div>