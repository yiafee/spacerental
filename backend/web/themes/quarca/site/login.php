<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper login_wrap">
      
      <div class="member-container-inside">
          <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="form-group">
                <?= $form->field($model, 'email', [
                            'template' => '<div class="row"><div class="col-md-12">{input}{hint}</div></div>',
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('email'),
                            ],
                        ])->textInput(['class'=>'form-control top'])->label(false) ?>
            </div>
            
            <div class="form-group">
                <?= $form->field($model, 'password', [
                            'template' => '<div class="row"><div class="col-md-12">{input}{hint}</div></div>',
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('Password'),
                            ],
                        ])->passwordInput(['class'=>'form-control bottom'])->label(false) ?>
            </div>
            <div class="form-group">
              <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
            </div>
          <?php ActiveForm::end(); ?>
      </div><!-- member-container-inside -->

      <p style="text-align:center;"><a href="<?= Url::toRoute(['/site/forgot_password']); ?>">Forgot Password?</a></p>
      
      <p><small><?= Yii::$app->params['copyright_text']; ?></small></p>
      
      
  </div><!-- wrapper -->
