<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use frontend\models\LoginForm;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
      <meta charset="<?= Yii::$app->charset ?>"/>
      <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <?= Html::csrfMetaTags(); ?>
      
      <title><?= Html::encode($this->title) ?></title>

      <?php $this->head() ?>

      <link href="<?php echo $this->theme->baseUrl; ?>/assets/css/style.css" rel="stylesheet">

      <?php
          $this->registerJsFile($this->theme->baseUrl."/assets/js/bootstrap.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
          $this->registerJsFile($this->theme->baseUrl."/assets/js/bootstrap-dialog.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
      ?>

</head>
    
<body>
    <div class="container-fluid header_wrap">
      <div class="container main_header">
        <div class="row">


          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="row">

                <div class="logo">
                  <a href="<?= Url::base(''); ?>">
                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/logo.png" alt="Logo">
                  </a>
                </div>

            </div>
          </div>

          <?php
            if(!isset(\Yii::$app->user->identity)){
              $login_model = new LoginForm();
          ?>

            <div class="col-md-6 pull-right">
              <div class="row">
                <?php $form = ActiveForm::begin([
                                                  'id' =>'login',
                                                  'action' => ['/site/login'],
                                                  'options' => [
                                                    'class' => 'login_form',
                                                  ],
                                                  'enableClientValidation' => true,
                                                 ]); ?>

                  <div class="col-md-4 col-md-offset-2"> 
                    <?= $form->field($login_model, 'email', [
                                        'template' => "{input}\n{error}"
                                      ])->textInput(['maxlength' => 255,'placeholder'=>'Email']); ?>
                    <?php
                      if(\Yii::$app->getSession()->hasFlash('success')){
                        echo \Yii::$app->getSession()->getFlash('success');
                      }
                    ?>
                    <p><a href="<?= Url::toRoute(['/user/signup']); ?>">Need an account?</a></p>
                  </div>

                  <div class="col-md-4"> 
                    <?= $form->field($login_model, 'password', [
                                        'template' => "{input}\n{error}"
                                      ])->passwordInput(['maxlength' => 255,'placeholder'=>'Password']); ?>
                    <p><a href="<?= Url::toRoute(['/user/forgot_pass']); ?>">Forgot you password?</a></p>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                        <?= Html::submitButton('SIGN IN', ['class' => 'signin_submit']) ?>
                    </div>
                  </div>



                <?php ActiveForm::end(); ?>
              </div>
            </div>
          <?php
            }else{
          ?>


            <div class="col-md-9 col-sm-9 col-xs-12">
              <div class="row">

                <div class="right_nav">
                  <ul>
                    <li><a href="<?= Url::toRoute(['/message/inbox']); ?>"><img src="<?= $this->theme->baseUrl; ?>/assets/img/message.png">&nbsp;&nbsp;1</a></li>
                    <li><a href="<?= Url::toRoute(['/'.\Yii::$app->user->identity->login_type.'/profile']); ?>"><img src="<?= $this->theme->baseUrl; ?>/assets/img/calendar.png"></a></li>
                    <li>
                      <span>Hi, 
                          <?php
                            if(isset(\Yii::$app->user->identity)){
                              echo \Yii::$app->user->identity->first_name;
                            }
                          ?>

                          <a href="<?= Url::toRoute(['/site/logout']); ?>" data-method="post">Logout</a>
                      </span>
                      <img src="<?= $this->theme->baseUrl; ?>/assets/img/three_dot.png">
                    </li>
                  </ul>
                </div>

              </div>
            </div>


          <?php
            }
          ?>

          



        </div>
      </div>
    </div>

    <!--header ends-->


    <?= $content ?>
    


    <?php $this->endBody() ?>
</body>
<?php
    $this->registerJs("
                    /*$('body').on('beforeSubmit', 'form#login', function () {

                         var form = $(this);

                         if (form.find('.has-error').length) {
                              return false;
                         }
                         $.ajax({
                              url: form.attr('action'),
                              type: 'post',
                              data: form.serialize(),
                              success: function (data) {

                                var dt = jQuery.parseJSON(data);
                                if(dt.result=='success'){
                                  location.reload();
                                }else{
                                  alert(dt.msg);
                                }


                              }
                         });

                         return false;
                    });*/

    ", yii\web\View::POS_END, 'unapprove');
?>


<!-- Mirrored from cazylabs.com/themes-demo/quarca/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Apr 2015 20:06:23 GMT -->
</html>
<?php $this->endPage() ?>