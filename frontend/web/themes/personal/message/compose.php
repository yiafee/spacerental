<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use frontend\models\User;

$this->title = 'Compose';
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



<?php echo $this->render('/'.\Yii::$app->user->identity->login_type.'/_top_part'); ?>


<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">


                <div class="col-md-12">
                    <div class="row">
                        
                            <div class="col-md-3">
                                <div class="side_nav_cont side_nav_cont_inner">
                                    <ul>
                                        <?php echo $this->render('_side_menu'); ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                	
                                    <?php $form = ActiveForm::begin(['id' => 'profile-form']); ?>
                                    <div class="col-md-12" style="padding:0 30px;">
                                        <h4>WRITE YOUR MESSAGE</h4>
                                    </div>
                                    
                                    <div class="col-md-6">
                                                

                                        <div class="col-md-12">
                                            <div class="row">
                                                <?= $form->field($model, 'to')
                                                            ->dropDownList(
                                                                User::getUserlist()
                                                            );?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <?= $form->field($model, 'subject')->textInput(['maxlength' => 255]) ?>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">

                                        
                                        <div class="col-md-12">
                                            <div class="row">
                                                <?= $form->field($model, 'message')->textArea() ?>
                                            </div>
                                        </div>

                                        <div class="form-group save_continue">
                                            <?= Html::submitButton('Send', ['class' =>'btn btn-primary ']) ?>
                                        </div>

                                    </div>

                                <?php ActiveForm::end(); ?>

                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <p>&nbsp;</p>
                                <?php
                                    if(\Yii::$app->getSession()->hasFlash('success')){
                                        echo '<p class="success">'.\Yii::$app->getSession()->getFlash('success').'</p>';
                                    }
                                ?>
                            </div>


                    </div>
                </div>



            </div>
        </div>
    </div>
</div>