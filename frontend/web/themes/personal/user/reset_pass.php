
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="login_bg">
            <div class="container">
                <div class="row">
                    
                    <h2>&nbsp;</h2>

                    <div class="col-md-12">
                        <div class="row">
                            <?php $form = ActiveForm::begin(['id' => 'form-reset']); ?>

                                <div class="col-md-4 col-md-offset-4">
                                    <div class="row">
                                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]); ?>


                                        <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255]); ?>


                                        <div class="form-group">
                                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                                        </div>

                                    </div>
                                </div>
                            <?php ActiveForm::end(); ?>

							<div class="col-md-12">
								<?php
								    if(Yii::$app->session->hasFlash('success')){
								        echo '<p>&nbsp;</p>';
								        echo '<p class="success">'.Yii::$app->session->getFlash('success').'</p>';
								    }
								?>
							</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>




<div class="container-fluid footer_find">
    <div class="row">
        <p><a href="#">FIND OUT HOT SPACES AROUND YOU</a></p>
    </div>
</div>


<?php
    $this->registerJs("
        expand_bg();
        $(window).resize(function(){
            expand_bg();
        });

        function expand_bg(){
            var window_height = parseInt($(window).height());
            $('.login_bg').css('height',(window_height)+'px');
        }
                    
    ", yii\web\View::POS_READY, 'login_bg');
?>
