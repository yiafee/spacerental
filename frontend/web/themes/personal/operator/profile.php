<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use frontend\models\User;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    $cover_photo = \Yii::$app->session->get('f_user.cover_photo');
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



<?php echo $this->render('_top_part'); ?>



<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">


                <div class="col-md-12">
                    <div class="row">
                        
                            <div class="col-md-3">
                                
                                <div class="side_nav_cont">
                                    <div class="profile_pic">
                                        <?php
                                            $profile_pic = \Yii::$app->session->get('f_user.profile_pic');
                                            if(!empty($profile_pic)){
                                        ?>
                                            <img src="<?= Url::base('').'/'.$profile_pic; ?>">
                                        <?php
                                            }
                                        ?>
                                    </div>

                                    <ul>
                                        <li><a href="#">CHANGE PROFILE PICTURE</a></li>
                                        <li><a href="#">CHANGE PASSWORD</a></li>
                                        <li><a href="#" class="update_pf">UPDATE PERSONAL DETAILS</a></li>
                                    </ul>

                                </div>
                                    
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                <?php $form = ActiveForm::begin(['id' => 'profile-form']); ?>

                                    <div class="col-md-6">
                                                
                                        <div class="col-md-12">
                                            <div class="row">
                                                <?= $form->field($model, 'first_name')->textInput(['maxlength' => 255]) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <?= $form->field($model, 'last_name')->textInput(['maxlength' => 255]) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12 profile_date_of_birth">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label>Date of Birth</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 profile_date_of_birth_month">
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

                                                <div class="col-md-4 profile_date_of_birth_day">
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
                                                <div class="col-md-4 profile_date_of_birth_year">
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
                                        
                                        <div class="col-md-12">
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

                                        <div class="col-md-12">
                                            <div class="row">
                                                <?php
                                                    if(\Yii::$app->getSession()->hasFlash('success')){
                                                        echo '<p class="success">'.\Yii::$app->getSession()->getFlash('success').'</p>';
                                                    }
                                                ?>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-md-6">

                                        <div class="col-md-12">
                                            <div class="row">
                                                <?= $form->field($model, 'business_name')->textInput(['maxlength' => 255]) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <?= $form->field($model, 'phone')->textInput(['maxlength' => 255]) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <?= $form->field($model, 'city')->textInput(['maxlength' => 255]) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <?= $form->field($model, 'zip')->textInput(['maxlength' => 255]) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
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

                                        <div class="form-group save_continue">
                                            <?= Html::submitButton('Save', ['class' =>'btn btn-primary ']) ?>
                                        </div>

                                    </div>

                                <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                


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

        var state = '$state';

        if(state!='post'){
            hide_field();
        }
        

        $('.update_pf').on('click',function(){
            if($(this).hasClass('open')){
                hide_field();
                $(this).removeClass('open');
            }else{
                show_field();
                $(this).addClass('open');
            }
            return false;
        });

        function show_field(){
            $('#profile-form').find('input, textarea, button, select').removeAttr('disabled');
            $('#profile-form').find('input, textarea, button, select').css('cursor', 'pointer');

            $('.save_continue').show();
        }

        function hide_field(){
            $('#profile-form').find('input, textarea, button, select').attr('disabled','disabled');
            $('#profile-form').find('input, textarea, button, select').css('cursor', 'default');

            $('.save_continue').hide();
        }
        
                    
    ", yii\web\View::POS_READY, 'login_bg');
?>