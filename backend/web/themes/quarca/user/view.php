<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$this->registerJsFile(Url::base()."/imgareaselect/scripts/jquery.imgareaselect.pack.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<link rel="stylesheet" type="text/css" href="<?= Url::base(''); ?>/imgareaselect/css/imgareaselect-default.css" />


<?= $this->render('sidebar'); ?>

<div class="col-md-9">

    <div class="col-md-7 col-sm-6">
        
                <p>&nbsp;</p>
                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'name',
                        'email:email',
                        'username',
                        [                      // the owner name of the model
                            'label' => 'Status',
                            'value' => ($model->status==1)?'Active':'Inactive',
                        ],
                    ],
                ]) ?>

            
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



    <div class="col-md-5 col-sm-6 product_image">
            <p>&nbsp;</p>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="profile_image">
                        <img src="<?= Url::base(''); ?>/user_img/<?= $model->image; ?>" class="profile_image_m">
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                        
                    <?php
                        
                        echo FileInput::widget([
                            'model' => $model,
                            'attribute' => 'image',
                            'options'=>[
                                'multiple'=>false
                            ],
                            'pluginOptions' => [
                                'uploadUrl' => Url::to(['/user/upload_pic']),
                                'uploadExtraData' => [
                                    'id' => $model->id,
                                ],
                                'allowedFileExtensions' => ['jpg', 'png'],
                                'dropZoneEnabled' =>false,
                                'showUpload' => false,
                                'initialPreviewShowDelete' => false,
                                'browseLabel' => 'Change Profile Pic',
                                'showRemove' => false,
                                'showCancel' => false
                            ],
                            'pluginEvents' => [
                                'fileimageloaded' => 'function(event, previewId){
                                    $("#user-image").fileinput("upload");
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

?>