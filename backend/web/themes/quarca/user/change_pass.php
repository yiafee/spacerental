<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('sidebar'); ?>

<div class="col-md-9">


        <div class="col-md-6 col-sm-6">
            <div class="row">

                <?php
                    if(Yii::$app->session->hasFlash('success')){
                        echo '<p>&nbsp;</p>';
                        echo '<p class="success">'.Yii::$app->session->getFlash('success').'</p>';
                    }
                ?>

                        <h2><span>Change Password</span></h2>
                        <?php $form = ActiveForm::begin(['enableAjaxValidation' => false]); ?>

                        <?= $form->field($model, 'old_password')->passwordInput(['maxlength' => 255]); ?>
                        <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => 255]); ?>
                        <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255]); ?>


                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' =>'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

            </div>
        </div>

        
</div>