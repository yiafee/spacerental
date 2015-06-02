<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Land */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="land-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'short_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'power_source')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'public_restroom')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'property_type')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'property_size')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'street_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
