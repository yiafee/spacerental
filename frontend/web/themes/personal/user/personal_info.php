<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use frontend\models\User;

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
                            
                            <div class="col-md-2 <?= ($type=='landowner')?'':'col-md-offset-1'; ?> first active">
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

                            <div class="col-md-2 <?= ($type=='landowner')?'':'b_last'; ?>">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_inactive.png">
                                </div>
                            </div>
                            <?php
                                if($type=='landowner'){
                            ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_inactive.png">
                                </div>
                            </div>
                            <?php
                                }
                            ?>

                            <div class="col-md-2">
                                <div class="row">
                                    
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12 registration_progress">
                        <div class="row">
                            
                            <div class="col-md-2 <?= ($type=='landowner')?'':'col-md-offset-1'; ?> first complete">
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

                            <?php
                                if($type=='landowner'){
                            ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <p>ADD YOUR PROPERTY</p>
                                </div>
                            </div>
                            <?php
                                }
                            ?>

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
                                                
                                                <div class="col-md-12 dob_field">
                                                    <div class="row">
                                                        <?= $form->field($model, 'first_name')->textInput(['maxlength' => 255]) ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 dob_field">
                                                    <div class="row">
                                                        <?= $form->field($model, 'last_name')->textInput(['maxlength' => 255]) ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 dob_field">
                                                    <div class="row">
                                                        <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 dob_field">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <label>Date of Birth</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <?= $form->field($model, 'month')
                                                                    ->dropDownList(
                                                                        [
                                                                            '01'=>'January',
                                                                            '02'=>'February',
                                                                            '03'=>'March',
                                                                            '04'=>'April',
                                                                            '05'=>'May',
                                                                            '06'=>'June',
                                                                            '07'=>'July',
                                                                            '08'=>'August',
                                                                            '09'=>'September',
                                                                            '10'=>'October',
                                                                            '11'=>'November',
                                                                            '12'=>'December',
                                                                        ],
                                                                        ['prompt'=>'Month']
                                                                    )->label(false);?>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <?= $form->field($model, 'day')
                                                                    ->dropDownList(
                                                                        [
                                                                            '01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10',
                                                                            '11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20',
                                                                            '21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30',
                                                                            '31'=>'31'
                                                                        ],
                                                                        ['prompt'=>'Day']
                                                                    )->label(false);?>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <?= $form->field($model, 'year')
                                                                    ->dropDownList(
                                                                        User::getYears('1997', 82),
                                                                        ['prompt'=>'Year']
                                                                    )->label(false);?>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <?= $form->field($model, 'date_of_birth')->begin(); ?>
                                                        <?= Html::error($model,'date_of_birth', ['class' => 'help-block']); ?>
                                                        <?= $form->field($model, 'date_of_birth')->end(); ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12 dob_field">
                                                    <div class="row">
                                                        <?= $form->field($model, 'gender')
                                                                    ->dropDownList(
                                                                        [
                                                                            'male'=>'Male',
                                                                            'female'=>'Female'
                                                                        ],
                                                                        ['prompt'=>'Gender']
                                                                    );?>
                                                    </div>
                                                </div>


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

                                            <?= $form->field($model, 'country')
                                                                    ->dropDownList(
                                                                        [
                                                                            'Bangladesh'=>'Bangladesh',
                                                                            'India'=>'India',
                                                                            'Pakistan'=>'Pakistan',
                                                                            'Nepal'=>'Nepal',
                                                                            'Myanmar'=>'Myanmar'
                                                                        ]
                                                                    );?>

                                        </div>
                                    </div>

                                <?php ActiveForm::end(); ?>
                                
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="row mail_warning">
                                        <img src="<?= $this->theme->baseUrl; ?>/assets/img/exclam.png" alt="!">
                                        <p>Please provide the mandatory information. </p>
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

