<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use kartik\file\FileInput;


$this->title = 'Payment Method';
$this->params['breadcrumbs'][] = $this->title;


?>


<?php
    if(!empty($cover_photo)){

?>
    
    <style type="text/css">
        .main_banner_bg{
            background: url("<?= Url::base('').'/'.$cover_photo; ?>") no-repeat;
            -moz-background-size: cover;
            -webkit-background-size: cover;
            -ms-background-size: cover;
            background-size: cover;
        }
    </style>

<?php
    }
?>

<div class="container-fluid">
    <div class="row">
        <div class="main_banner_bg">
            <div class="container">
                <div class="row">
                    
                    <div class="profile_pic_cont">
                        <?php
                            if(!empty($profile_photo)){
                        ?>
                            <img src="<?= Url::base('').'/'.$profile_photo; ?>">
                        <?php
                            }
                        ?>
                    </div>

                    <h2>WELCOME <?= \Yii::$app->user->identity->first_name; ?>!</h2>
                    <p class="p_main">PROVIDE FEW MORE INFORMATION AND YOU ARE READY TO GO</p>

                    <div class="col-md-12 registration_progress_bar">
                        <div class="row">
                            
                            <div class="col-md-2 first <?= ($type=='landowner')?'':'col-md-offset-1'; ?> active">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_complete.png">
                                </div>
                            </div>

                            <div class="col-md-2 active">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_complete.png">
                                </div>
                            </div>

                            <div class="col-md-2 active">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_complete.png">
                                </div>
                            </div>

                            <div class="col-md-2 <?= ($type=='landowner')?'':'b_last'; ?> active">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_active.png">
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
                            
                            <div class="col-md-2 first <?= ($type=='landowner')?'':'col-md-offset-1'; ?> complete">
                                <div class="row">
                                    <p>EMAIL VERIFICATION</p>
                                </div>
                            </div>

                            <div class="col-md-2 complete">
                                <div class="row">
                                    <p>BASIC INFORMATION</p>
                                </div>
                            </div>

                            <div class="col-md-2 complete">
                                <div class="row">
                                    <p>PROFILE PICTURE</p>
                                </div>
                            </div>

                            <div class="col-md-2 active">
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
                        
                        <div class="col-md-4 prosonal_info">
                            
                            <div class="row">
                                
                                <h5>Bank Account</h5>

                                <?php $form = ActiveForm::begin(['id' => 'personal-info-form']); ?>
                                    
                                    <?= $form->field($model, 'type')->dropDownList(
                                                                        [
                                                                            'Bank'=>'Bank',
                                                                            'Paypal'=>'Paypal'
                                                                        ],
                                                                        ['prompt'=>'Account type']
                                                                    );?>
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
                                    <?= $form->field($model, 'value')->textInput(['maxlength' => 255]) ?>

                                    <div class="form-group save_continue save_continue_payment">
                                        <?= Html::submitButton('Save &amp; Continue', ['class' =>'btn btn-primary ']) ?>
                                    </div>

                                <?php ActiveForm::end(); ?>

                                <?php
                                    if($type=='landowner'){
                                ?>
                                <a class="btn btn-sm btn-primary pull-right" href="<?= Url::toRoute(['/user/add_property','type'=>$type]); ?>">Skip & Continue</a>
                                <?php
                                    }else{
                                ?>
                                <a class="btn btn-sm btn-primary pull-right" href="<?= Url::toRoute(['/user/complete','type'=>$type]); ?>">Skip & Continue</a>
                                <?php
                                    }
                                ?>
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



<?php
    $this->registerJs("

        $('#useracc-type').on('change',function(){
            if($(this).val()=='Paypal'){
                $('.field-useracc-value label').html('Account Email');
            }else{
                $('.field-useracc-value label').html('Account No');
            }
        });
                    
    ", yii\web\View::POS_READY, 'login_bg');
?>