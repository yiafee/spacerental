<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use frontend\models\User;
use frontend\models\UserImg;
use kartik\file\FileInput;


$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Url::base()."/imgareaselect/scripts/jquery.imgareaselect.pack.js", ['depends' => [\yii\web\JqueryAsset::className()]]);


?>
<link rel="stylesheet" type="text/css" href="<?= Url::base(''); ?>/imgareaselect/css/imgareaselect-default.css" />


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

<div class="modal fade" id="myModal_crop_view"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          
          <div class="modal-body">

            <div class="col-md-12">
                <div class="row" style="text-align:center;">

                    <img src="<?= Url::base(''); ?>/user_img/1432127015Tulips.jpg" class="pro_img">
                    <div class="img_name" style="display:none;" name=""></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <input type="button" name="crop" class="btn btn-primary btn-sm pull-right crop" value="Save">
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
                        
                            <div class="col-md-3">
                                
                                <div class="side_nav_cont product_image">
                                    <div class="profile_pic profile_image">
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
                                        <li>
                                            <?php
                                                $user_img_model = new UserImg();
                                                echo FileInput::widget([
                                                    'model' => $user_img_model,
                                                    'attribute' => 'path',
                                                    'options'=>[
                                                        'multiple'=>false
                                                    ],
                                                    'pluginOptions' => [
                                                        'uploadUrl' => Url::to(['/user/upload_pic','type'=>'landowner']),
                                                        'uploadExtraData' => [
                                                            'id' => \Yii::$app->user->identity->id,
                                                            'img_type'=>'profile',
                                                            'instance'=>'path',
                                                            'from'=>'inner'
                                                        ],
                                                        'allowedFileExtensions' => ['jpg', 'png'],
                                                        'dropZoneEnabled' =>false,
                                                        'showUpload' => false,
                                                        'initialPreviewShowDelete' => false,
                                                        'browseLabel' => 'Change Profile Picture',
                                                        'showRemove' => false,
                                                        'showCancel' => false,
                                                        'browseIcon'=>'',
                                                        'browseClass'=>'profile_pic_btn'
                                                    ],
                                                    'pluginEvents' => [
                                                        'fileimageloaded' => 'function(event, previewId){
                                                            $("#userimg-path").fileinput("upload");
                                                        }',
                                                        'fileuploaded'=>'function(event, data, previewId, index){
                                                            $(".pro_img").attr("src",data.response.files.url);
                                                            $(".img_name").attr("name",data.response.files.name);
                                                            $("#myModal_crop_view").modal("show");

                                                            setTimeout(function(){
                                                                sd();
                                                            },500);
                                                            
                                                        }',
                                                        'filebatchuploadcomplete' => 'function(event, files, extra){
                                                            $(".fileinput-remove-button").click();
                                                        }',
                                                    ]
                                                ]);
                                            ?>
                                        </li>
                                        <li><a href="<?= Url::toRoute(['/user/change_password']); ?>">CHANGE PASSWORD</a></li>
                                        <li><a href="#" class="update_pf">UPDATE PERSONAL DETAILS</a></li>
                                    </ul>

                                </div>
                                    
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                <?php $form = ActiveForm::begin(['id' => 'profile-form']); ?>
                                    <div class="col-md-12" style="padding:0 30px;">
                                        <h4>YOUR PERSONAL DETAILS</h4>
                                    </div>
                                    
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
            $('#reset-form').hide();
            $('#profile-form').show();

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



    $this->registerJs('
                    
        function sd(){
            var ias = $(".pro_img").imgAreaSelect({ 
                    aspectRatio:"1:1", 
                    handles: true,
                    instance: true 
                });

                ias.setSelection(0, 0, 200, 200, true);
                ias.setOptions({ show: true });
                ias.update();

                $(".crop").on("click",function(){
                    get_crop_data()
                });

                function get_crop_data(){
                        var data = ias.getSelection();
                        var height = data.height;
                        var width = data.width;
                        var x = data.x1;
                        var y = data.y1;
                        var url = $(".img_name").attr("name");

                        $.ajax({
                            type : "POST",
                            dataType : "json",
                            url : "'.Url::toRoute('user/crop_img').'",
                            data: {height:height,width:width,x:x,y:y,url:url},
                            beforeSend : function( request ){

                            },
                            success : function( data )
                                { 
                                    console.log(data.url);

                                    $(".profile_image").html("<img src=\""+data.url+"\">");
                                    $(".profile_pic_cont").html("<img src=\""+data.url+"\">");
                                    ias.cancelSelection();
                                    $("#myModal_crop_view").modal("hide");
                                }
                        });
                    }
        }
    

    
    ', yii\web\View::POS_READY, 'imagecrop');
?>