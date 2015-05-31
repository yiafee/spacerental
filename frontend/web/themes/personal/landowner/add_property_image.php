<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use dosamigos\fileupload\FileUploadUI;


$this->title = $model->title;
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
                                <div class="side_nav_cont side_nav_cont_inner">
                                    <ul>
                                        <li><a class="<?php echo (Yii::$app->controller->action->id=='viewproperty')?'active':''; ?>" href="<?php echo Url::toRoute(['/landowner/viewproperty/','id'=>$model->id,'title'=>$model->title]); ?>">Property Basic Info</a></li>
                                        <li><a class="<?php echo (Yii::$app->controller->action->id=='add_property_image')?'active':''; ?>" href="<?php echo Url::toRoute(['/landowner/add_property_image/','id'=>$model->id,'title'=>$model->title]); ?>">Property Images</a></li>
                                        <li><a class="<?php echo (Yii::$app->controller->action->id=='add_property_schedule')?'active':''; ?>" href="<?php echo Url::toRoute(['/landowner/add_property_schedule/','id'=>$model->id,'title'=>$model->title]); ?>">Property Schedule</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="land_image_list">
                                                <div class="row">
                                                <?php
                                                    if(!empty($img_all)){
                                                        foreach ($img_all as $key) {
                                                            
                                                ?>
                                                    <div class="col-md-4" id="image_<?= $key->id; ?>">
                                                        <div class="img"> 
                                                            <div id="loader_<?= $key->id; ?>"></div> 
                                                            <div class="del_image" data_id="<?= $key->id; ?>">x</div>

                                                            <img src="<?= Url::base('').'/'.$key->path; ?>" alt="<?= $key->title; ?>">
                                                        </div>
                                                        <div class="img_title">
                                                            
                                                        </div>
                                                        <div class="img_desc">
                                                            
                                                        </div>
                                                    </div>

                                                <?php
                                                        }
                                                    }
                                                ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="row">
                                            <?=
                                                FileUploadUI::widget([
                                                    'model' => $img_model,
                                                    'attribute' => 'path',
                                                    'url' => ['landowner/upload_land_photo'],
                                                    'gallery' => false,
                                                    'fieldOptions' => [
                                                            'accept' => 'image/*'
                                                    ],
                                                    'clientOptions' => [
                                                            'maxFileSize' => 2000000,
                                                            'downloadTemplateId' => null,
                                                            'uploadTemplateId' => 'template-upload',
                                                    ],
                                                    'clientEvents' => [
                                                            'fileuploadsubmit' => 'function(e, data) {
                                                                var inputs = data.context.find(":input");
                                                                /*if (inputs.filter(function () {
                                                                        return !this.value && $(this).prop("required");
                                                                    }).first().focus().length) {
                                                                    data.context.find("button").prop("disabled", false);
                                                                    return false;
                                                                }*/
                                                                data.formData = inputs.serializeArray();
                                                                data.formData.push({"name":"land_id","value": '.$model->id.'});
                                                                console.log(data.formData);
                                                            }',
                                                            'fileuploaddone' => 'function(e, data) {
                                                                 console.log(data);
                                                                $.each(data._response.result.files, function (index, file) {
                                                                    console.log(file.name);
                                                                    
                                                                });

                                                                $(".land_image_list .row").append(data._response.result.view);

                                                            }',
                                                            'fileuploadfail' => 'function(e, data) {
                                                                    console.log(e);
                                                                    console.log(data);
                                                                }',
                                                            'fileuploaddestroy' => 'function(e, data) {
                                                                    
                                                                    console.log(data);
                                                                }',
                                                    ],
                                                ]);
                                            ?>
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


<?php
    $this->registerJs("

        $(document).delegate('.del_image', 'click', function() {

            var id = $(this).attr('data_id');
            var item = $(this);

            $.ajax({
                type : 'POST',
                dataType : 'json',
                url : '".Url::toRoute('landowner/delete_image')."',
                data: {id:id},
                beforeSend : function( request ){
                   $('#loader_'+id).addClass('loader');
                },
                success : function( data ){ 
                    $('#loader_'+id).removeClass('loader');

                    if(data.result=='Success'){
                        $('#image_'+id).remove();
                    }else{
                        alert('Sorry unable to delete image.');
                    } 
                }
            });
            return false;
        });
    ", yii\web\View::POS_READY, 'delete_image');

?>

