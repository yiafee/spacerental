<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Confirm Email';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="main_banner_bg">
            <div class="container">
                <div class="row">
                    
                    <h2>WELCOME CHRIS!</h2>
                    <p class="p_main">PROVIDE FEW MORE INFORMATION AND YOU ARE READY TO GO</p>

                    <div class="col-md-12 registration_progress_bar">
                        <div class="row">
                            <div class="col-md-1"></div>

                            <div class="col-md-2 first active">
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
                            
                            <div class="col-md-1"></div>

                            <div class="col-md-2 first active">
                                <div class="row">
                                    <p>EMAIL VERIFICATION</p>
                                </div>
                            </div>

                            <div class="col-md-2">
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
                        
                        <?php if(isset($verified) && $verified=='yes'){

                        ?>
                            <p>&nbsp;</p>
                            <p>Are you Landowner? <a href="<?= Url::toRoute(['/user/personal_info','type'=>'landowner']); ?>">Click here</a></p>
                            <p>Or if you are Food Truck operator <a href="<?= Url::toRoute(['/user/personal_info','type'=>'operator']); ?>">Click here</a></p>

                        <?php
                            }else{
                        ?>
                            <div class="col-md-8 verification_box">
                                
                                    <h4>VERIFY YOU EMAIL ADDRESS</h4>
                                    <p>We now need to verify you email address. We’ve sent an email to 

                                    <?php if(isset($email)){ ?>
                                        <a href="mailto:<?= $email; ?>"><?= $email; ?></a>  
                                    <?php } ?>

                                    to<br/> verify your address. Please click in the link in that email to continue.</p>
                                    
                                    <input type="button" name="resend" value="RESEND VERIFICATION EMAIL">
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

                        <?php
                            }
                        ?>

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

