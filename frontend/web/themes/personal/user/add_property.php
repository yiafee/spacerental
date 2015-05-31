<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use kartik\file\FileInput;


$this->title = 'Add Property';
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
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_complete.png">
                                </div>
                            </div>

                            <?php
                                if($type=='landowner'){
                            ?>
                            <div class="col-md-2 active">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_active.png">
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

                            <div class="col-md-2 complete">
                                <div class="row">
                                    <p>PAYMENT METHODS</p>
                                </div>
                            </div>

                            <?php
                                if($type=='landowner'){
                            ?>
                            <div class="col-md-2 active">
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
                            
                            <div class="row">
                                
                                <h5>Add your Property</h5>

                                
                            </div> 
                                
                        </div>



                        <div class="col-md-12">
                            <div class="row">

                                <?php $form = ActiveForm::begin(['id' => 'add_property_form']); ?>
                                <div class="col-md-4">
                                        
                                        
                                            <?= $form->field($model, 'address')->textArea(); ?>
                                            <?= $form->field($model, 'short_desc')->textArea() ?>
                                            <?= $form->field($model, 'street_address')->textArea(); ?>

                                            
                                </div>


                                <div class="col-md-4">

                                        <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

                                        <?= $form->field($model, 'power_source')->dropDownList(
                                                                        [
                                                                            'Yes'=>'Yes',
                                                                            'No'=>'No'
                                                                        ],
                                                                        ['prompt'=>'Power Source']
                                                                    );?>
                                        <?= $form->field($model, 'public_restroom')->dropDownList(
                                                                        [
                                                                            'Yes'=>'Yes (Within 100 ft.)',
                                                                            'No'=>'No'
                                                                        ],
                                                                        ['prompt'=>'Public Restroom']
                                                                    );?>

                                        <?= $form->field($model, 'property_type')->dropDownList(
                                                                        [
                                                                            'Private'=>'Private',
                                                                            'Public'=>'Public'
                                                                        ],
                                                                        ['prompt'=>'Property Type']
                                                                    );?>

                                        
                                        
                                        <?= $form->field($model, 'property_size')->textInput(['maxlength' => 255]) ?>

                                        <div class="col-md-12">
                                            <div class="row">

                                                <div class="col-md-6" style="padding-left:0;">
                                                    <?= $form->field($model, 'latitude')->textInput(['maxlength' => 255]) ?>
                                                </div>

                                                <div class="col-md-6" style="padding-right:0;">
                                                    <?= $form->field($model, 'longitude')->textInput(['maxlength' => 255]) ?>
                                                </div>

                                            </div>
                                        </div>
                                        

                                        

                                        <div class="form-group save_continue save_continue_payment">
                                                <?= Html::submitButton('Save &amp; Continue', ['class' =>'btn btn-primary ']) ?>
                                            </div>

                                        

                                        <a class="btn btn-sm btn-primary pull-right" href="<?= Url::toRoute(['/user/complete','type'=>$type]); ?>">Skip & Continue</a>
                                </div>

                                <?php ActiveForm::end(); ?>
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