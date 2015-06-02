<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserF */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-f-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'zip')->textInput() ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'date_of_birth')->textInput() ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'reg_status')->textInput() ?>

    <?= $form->field($model, 'login_type')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
