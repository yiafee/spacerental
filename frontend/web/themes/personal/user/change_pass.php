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

$logged_type =  \Yii::$app->user->identity->login_type;
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



<?php echo $this->render('//'.$logged_type.'/_top_part'); ?>



<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">


                <div class="col-md-12">
                    <div class="row">
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
                                        <li><a href="<?= Url::toRoute(['/user/change_password']); ?>">CHANGE PASSWORD</a></li>
                                        <li><a href="<?= Url::toRoute(['/'.$logged_type.'/profile']); ?>" class="update_pf">UPDATE PERSONAL DETAILS</a></li>
                                    </ul>

                                </div>
                                    
                            </div>

                            <div class="col-md-6">
                                <div class="row">

                                    <div class="col-md-6">
                                        <?php
                                            if(Yii::$app->session->hasFlash('success')){
                                                echo '<p>&nbsp;</p>';
                                                echo '<p class="success">'.Yii::$app->session->getFlash('success').'</p>';
                                            }
                                        ?>

                                        
                                        <?php $form = ActiveForm::begin(['enableAjaxValidation' => false]); ?>

                                        <h4><span>Change Password</span></h4>
                                        
                                        <?= $form->field($model, 'old_password')->passwordInput(['maxlength' => 255]); ?>
                                        <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => 255]); ?>
                                        <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255]); ?>


                                        <div class="form-group">
                                            <?= Html::submitButton('Save', ['class' =>'btn btn-primary']) ?>
                                        </div>

                                        <?php ActiveForm::end(); ?>
                                    </div>

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
</div>





<div class="padding_btm_60"></div>

<div class="container-fluid footer_find">
    <div class="row">
        <p><a href="#">FIND OUT HOT SPACES AROUND YOU</a></p>
    </div>
</div>
            