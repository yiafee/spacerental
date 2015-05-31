<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use frontend\models\User;

?>

<div class="container-fluid">
    <div class="row">
        <div class="main_banner_bg">
            <div class="container">
                <div class="row">
                    <div class="profile_pic_cont">
                        <?php
                            $profile_pic = \Yii::$app->session->get('f_user.profile_pic');
                            if(!empty($profile_pic)){
                        ?>
                            <img src="<?= Url::base('').'/'.$profile_pic; ?>">
                        <?php
                            }
                        ?>
                    </div>
                    
                    <div class="col-md-6 col-md-offset-3 user_info_top">
                        <h2>WELCOME CHRIS!</h2>
                        <p>PROVIDE FEW MORE INFORMATION AND YOU ARE READY TO GO</p>
                    </div>

                    <div class="col-md-12 registration_progress">
                        <div class="row">
                            
                            <div class="col-md-2 first complete">
                                <div class="row">
                                    <p><a href="<?= Url::toRoute(['/landowner/dashboard']); ?>" class="<?php echo (Yii::$app->controller->action->id=='dashboard')?'active':''; ?>">DASHBOARD</a></p>
                                </div>
                            </div>

                            <div class="col-md-2 complete">
                                <div class="row">
                                    <p><a href="<?= Url::toRoute(['/landowner/inbox']); ?>" class="<?php echo (Yii::$app->controller->action->id=='inbox')?'active':''; ?>">INBOX</a></p>
                                </div>
                            </div>

                            <div class="col-md-2 complete">
                                <div class="row">
                                    <p><a href="<?= Url::toRoute(['/landowner/property']); ?>" class="<?php echo (Yii::$app->controller->action->id=='property' || Yii::$app->controller->action->id=='viewproperty' || Yii::$app->controller->action->id=='addproperty')?'active':''; ?>">YOUR PROPERTY</a></p>
                                </div>
                            </div>

                            <div class="col-md-2 complete">
                                <div class="row">
                                    <p><a href="<?= Url::toRoute(['/landowner/payment']); ?>" class="<?php echo (Yii::$app->controller->action->id=='payment')?'active':''; ?>">PAYMENT HISTORY</a></p>
                                </div>
                            </div>

                            <div class="col-md-2 complete">
                                <div class="row">
                                    <p><a href="<?= Url::toRoute(['/landowner/profile']); ?>" class="<?php echo (Yii::$app->controller->action->id=='profile')?'active':''; ?>">PROFILE</a></p>
                                </div>
                            </div>

                            <div class="col-md-2 complete">
                                <div class="row">
                                    <p><a href="<?= Url::toRoute(['/landowner/account']); ?>" class="<?php echo (Yii::$app->controller->action->id=='account')?'active':''; ?>">ACCOUNT</a></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>