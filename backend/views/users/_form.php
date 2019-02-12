<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\User */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php if ($model instanceof \common\models\forms\SignupForm) {
        echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
    } ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'authKey')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'accessToken')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'role_id')->dropDownList($roles, ['prompt' => 'Select Role']) ?>

    <!--    --><? //= $form->field($model, 'role_id')->dropDownList(
    //    // Метод find объекта ActiveQuery подготавливает запрос. select делает выборку по колонкам role_id и id.
    //    // indexBy сопоставляет индексы массива, который вернул селект, с индетификаторами колонки id.
    //    // column выбирает только первую колонку.
    //        \app\models\tables\Roles::find()->select(['name', 'id'])->indexBy('id')->column(),
    //        ['prompt' => 'Select Role']
    //    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
