<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use kartik\file\FileInput;


$this->title = 'Profile Picture';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Url::base()."/imgareaselect/scripts/jquery.imgareaselect.pack.js", ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<link rel="stylesheet" type="text/css" href="<?= Url::base(''); ?>/imgareaselect/css/imgareaselect-default.css" />




<div class="container-fluid">
    <div class="row">
        <div class="main_banner_bg">
            <div class="container">
                <div class="row">
                    
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

                            <div class="col-md-2">
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/bulet_active.png">
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

                            <div class="col-md-2 active">
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



<div class="modal fade" id="myModal_crop_view2"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          
          <div class="modal-body">

            <div class="col-md-12">
                <div class="row" style="text-align:center;">

                    <img src="<?= Url::base(''); ?>/user_img/1432127015Tulips.jpg" class="pro_img2">
                    <div class="img_name2" style="display:none;" name=""></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <input type="button" name="crop" class="btn btn-primary btn-sm pull-right crop2" value="Save">
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
                                
                                <h5>PROFILE PICTURE</h5>

                                <div class="product_image">
                                    <p>&nbsp;</p>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="profile_image">
                                                <img src="<?= Url::base(''); ?>/<?= $profile_pic; ?>" class="profile_image_m">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                                
                                            <?php
                                                
                                                echo FileInput::widget([
                                                    'model' => $model,
                                                    'attribute' => 'path',
                                                    'options'=>[
                                                        'multiple'=>false
                                                    ],
                                                    'pluginOptions' => [
                                                        'uploadUrl' => Url::to(['/user/upload_pic','type'=>$type]),
                                                        'uploadExtraData' => [
                                                            'id' => \Yii::$app->user->identity->id,
                                                            'img_type'=>'profile',
                                                            'instance'=>'path'
                                                        ],
                                                        'allowedFileExtensions' => ['jpg', 'png'],
                                                        'dropZoneEnabled' =>false,
                                                        'showUpload' => false,
                                                        'initialPreviewShowDelete' => false,
                                                        'browseLabel' => 'Change Profile Picture',
                                                        'showRemove' => false,
                                                        'showCancel' => false
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

                                        </div>
                                    </div>

                                    
                                </div>


                            </div> 
                                
                        </div>

                        <div class="col-md-8 prosonal_info">
                            <h5>COVER PHOTO</h5>


                            <div class="product_image">
                                    <p class="error">&nbsp;</p>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="profile_image2">
                                                <img src="<?= Url::base(''); ?>/<?= $cover_pic; ?>" class="profile_image_m2">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                                
                                            <?php
                                                
                                                echo FileInput::widget([
                                                    'model' => $model,
                                                    'attribute' => 'cover_photo',
                                                    'options'=>[
                                                        'multiple'=>false
                                                    ],
                                                    'pluginOptions' => [
                                                        'uploadUrl' => Url::to(['/user/upload_pic','type'=>$type]),
                                                        'uploadExtraData' => [
                                                            'id' => \Yii::$app->user->identity->id,
                                                            'img_type'=>'cover',
                                                            'instance'=>'cover_photo'
                                                        ],
                                                        'allowedFileExtensions' => ['jpg', 'png'],
                                                        'dropZoneEnabled' =>false,
                                                        'showUpload' => false,
                                                        'initialPreviewShowDelete' => false,
                                                        'browseLabel' => 'Change Cover Photo',
                                                        'showRemove' => false,
                                                        'showCancel' => false
                                                    ],
                                                    'pluginEvents' => [
                                                        'fileimageloaded' => 'function(event, previewId){
                                                            $("#userimg-cover_photo").fileinput("upload");
                                                        }',
                                                        'fileuploaded'=>'function(event, data, previewId, index){

                                                            if(data.response.valid=="yes"){
                                                                $(".pro_img2").attr("src",data.response.files.url);
                                                                $(".img_name2").attr("name",data.response.files.name);
                                                                $("#myModal_crop_view2").modal("show");

                                                                setTimeout(function(){
                                                                    sd2();
                                                                },500);
                                                            }else{
                                                                $(".error").html(data.response.valid);
                                                            }
                                                            
                                                            
                                                        }',
                                                        'filebatchuploadcomplete' => 'function(event, files, extra){
                                                            //$(".fileinput-remove-button").click();
                                                        }',
                                                    ]
                                                ]);
                                            ?>

                                        </div>
                                    </div>

                                    
                            </div>

                            <a class="btn btn-sm btn-primary pull-right" href="<?= Url::toRoute(['/user/payment_method','type'=>$type]); ?>">Continue</a>
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
                                    ias.cancelSelection();
                                    $("#myModal_crop_view").modal("hide");
                                }
                        });
                    }
        }
    

    
    ', yii\web\View::POS_READY, 'imagecrop');


    $this->registerJs('
                    

        function sd2(){
            var ias2 = $(".pro_img2").imgAreaSelect({ 
                    aspectRatio:"1:0.350", 
                    handles: false,
                    instance: true 
                });

                ias2.setSelection(0, 0, 300, 60, false);
                ias2.setOptions({ show: true });
                ias2.update();

                $(".crop2").on("click",function(){
                    get_crop_data2()
                });

                function get_crop_data2(){
                        var data = ias2.getSelection();
                        var height = data.height;
                        var width = data.width;
                        var x = data.x1;
                        var y = data.y1;
                        var url = $(".img_name2").attr("name");

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

                                    $(".profile_image2").html("<img src=\""+data.url+"\">");
                                    ias2.cancelSelection();
                                    $("#myModal_crop_view2").modal("hide");
                                }
                        });
                    }
        }
    

    
    ', yii\web\View::POS_READY, 'imagecrop_cover');

?>