<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\Land */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="land-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <div class="row">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'power_source')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'public_restroom')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'property_type')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'property_size')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'latitude')->textInput() ?>

            <?= $form->field($model, 'longitude')->textInput() ?>

            <?php
                echo $form->field($model, 'status')
                        ->dropDownList(
                            [   
                                '1'=>'Approved', 
                                '0'=>'Unapproved'
                            ],           // Flat array ('id'=>'label')
                            ['prompt'=>'Select Status']    // options
                        );
            ?>

            <?= $form->field($model, 'user_id')
                        ->dropDownList(
                            User::getUserlist()
                        );?>
        </div>
    </div>
    <div class="col-md-6">


        <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'short_desc')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'street_address')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
