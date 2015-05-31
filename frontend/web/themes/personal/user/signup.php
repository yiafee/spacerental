<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="login_bg">
            <div class="container">
                <div class="row">
                    
                    <h2>JOIN FOOD TRUCK SPACES DHAKA</h2>
                    <p class="p_main">FIND OUT, HOW WE CAN MAKE YOU MORE PROFITABLE</p>

                    <div class="col-md-12">
                        <div class="row">
                            <?php $form = ActiveForm::begin(['options' => [
                                                                'class' => 'signup_form'
                                                             ]]); ?>
                                
                                <?= $form->field($model, 'first_name', [
                                      'template' => "{input}\n{error}"
                                    ])->textInput(['maxlength' => 255,'placeholder'=>'FIRST NAME']); ?>

                                <?= $form->field($model, 'last_name', [
                                      'template' => "{input}\n{error}"
                                    ])->textInput(['maxlength' => 255,'placeholder'=>'LAST NAME']); ?>

                                <?= $form->field($model, 'email', [
                                      'template' => "{input}\n{error}"
                                    ])->textInput(['maxlength' => 255,'placeholder'=>'EMAIL']); ?>

                                <?= $form->field($model, 'password', [
                                      'template' => "{input}\n{error}"
                                    ])->passwordInput(['maxlength' => 255,'placeholder'=>'PASSWORD']); ?>

                                <?= $form->field($model, 'city')
                                                        ->dropDownList(
                                                            array (
                                                                    ''=>'CITY', 
                                                                    'DHAKA'=>'DHAKA') 
                                                        )->label(false); ?>

                                <?= $form->field($model, 'zip', [
                                      'template' => "{input}\n{error}"
                                    ])->textInput(['maxlength' => 255,'placeholder'=>'ZIP']); ?>

                                <div class="form-group userf-signup-submit">
                                    <?= Html::submitButton('SIGN UP', ['class' => 'signup_submit']) ?>
                                </div>

                            <?php ActiveForm::end(); ?>
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
