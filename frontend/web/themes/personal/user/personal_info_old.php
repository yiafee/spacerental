<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Personal Information';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="main_banner_bg">
            <div class="container">
                <div class="row">
                    
                    <h2>WELCOME <?= \Yii::$app->user->identity->first_name; ?>!</h2>
                    <p class="p_main">PROVIDE FEW MORE INFORMATION AND YOU ARE READY TO GO</p>

                    <div class="col-md-12 registration_progress_bar">
                        <div class="row">
                            
                            <div class="col-md-2 active">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_complete.png">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_active.png">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_inactive.png">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_inactive.png">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_inactive.png">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                    
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12 registration_progress">
                        <div class="row">
                            
                            <div class="col-md-2 complete">
                                <div class="row">
                                    <p>EMAIL VERIFICATION</p>
                                </div>
                            </div>

                            <div class="col-md-2 active">
                                <div class="row">
                                    <p>BASIC INFORMATION</p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                    <p>PROFILE PICTURE</p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                    <p>PAYMENT METHODS</p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                    <p>ADD YOUR PROPERTY</p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                    <p>COMPLETE</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">


                <div class="col-md-12">
                    <div class="row">
                        
                        <div class="col-md-8 prosonal_info">
                            
                                <h4>PROVIDE YOUR PERSONAL INFORMATION</h4>
                                
                                <?php $form = ActiveForm::begin(['id' => 'personal-info-form']); ?>

                                    <div class="col-md-4">
                                        <div class="row">
                                            
                                            <h5>BASIC DETAILS</h5>
                                            
                                                <?= $form->field($model, 'first_name')->textInput(['maxlength' => 255]) ?>

                                                <?= $form->field($model, 'last_name')->textInput(['maxlength' => 255]) ?>

                                                <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

                                                <?= $form->field($model, 'date_of_birth')->textInput(['maxlength' => 255]) ?>
                                                
                                                <?= $form->field($model, 'gender')->textInput(['maxlength' => 255]) ?>

                                                <div class="form-group save_continue">
                                                    <?= Html::submitButton('Save &amp; Continue', ['class' =>'btn btn-primary ']) ?>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="row">

                                            <h5>CONTACT DETAILS</h5>

                                            <?= $form->field($model, 'business_name')->textInput(['maxlength' => 255]) ?>
                                            
                                            <?= $form->field($model, 'phone')->textInput(['maxlength' => 255]) ?>

                                            <?= $form->field($model, 'city')->textInput(['maxlength' => 255]) ?>

                                            <?= $form->field($model, 'zip')->textInput(['maxlength' => 255]) ?>

                                            <?= $form->field($model, 'country')->textInput(['maxlength' => 255]) ?>

                                        </div>
                                    </div>

                                <?php ActiveForm::end(); ?>
                                
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="row mail_warning">
                                        <img src="<?= $this->theme->baseUrl; ?>/assets/img/exclam.png" alt="!">
                                        <p>Please check you Spam folder, in case you are not 
                                            receiving the verrification email. </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>
</div>





<div class="padding_btm_60"></div>

<div class="container-fluid footer_find">
    <div class="row">
        <p><a href="#">FIND OUT HOT SPACES AROUND YOU</a></p>
    </div>
</div>

