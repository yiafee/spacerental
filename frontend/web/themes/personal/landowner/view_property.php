<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;


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

                            <div class="col-md-6">
                                <div class="row">
                                
                                    <?php $form = ActiveForm::begin(['id' => 'add_property_form_inner']); ?>
                                        <div class="col-md-12" style="padding:0 30px;">
                                            <h4>BASIC INFO</h4>
                                        </div>

                                        <div class="col-md-6">
                                                    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

                                                    <?= $form->field($model, 'address')->textArea(); ?>
                                                    <?= $form->field($model, 'short_desc')->textArea() ?>
                                                    <?= $form->field($model, 'street_address')->textArea(); ?>
                                        </div>

                                        <div class="col-md-6">
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



