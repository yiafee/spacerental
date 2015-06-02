<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserF */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-f-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">

        <?= $form->field($model, 'first_name')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'last_name')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => 20]) ?>

        <?= $form->field($model, 'city')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'zip')->textInput() ?>
    </div>

    <div class="col-md-6">

        <?= $form->field($model, 'country')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'gender')
                    ->dropDownList(
                        [   
                            'male'=>'Male', 
                            'female'=>'Female'
                        ]
                    );
        ?>

        <?= $form->field($model, 'date_of_birth')->textInput() ?>

        <?= $form->field($model, 'status')
                    ->dropDownList(
                        [   
                            '1'=>'Active', 
                            '0'=>'Inactive'
                        ]
                    );
        ?>

        <?= $form->field($model, 'reg_status')
                    ->dropDownList(
                        [   
                            '1'=>'Completed', 
                            '0'=>'Incomplete'
                        ]
                    );
        ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
