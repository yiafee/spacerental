<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
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
                            <form name="signup" class="signup_form">
                                
                                <input type="text" name="fname" placeholder="FIRST NAME">
                                <input type="text" name="lname" placeholder="LAST NAME">
                                <input type="text" name="email" placeholder="EMAIL ADDRESS">
                                <input type="text" name="password" placeholder="PASSWORD">
                                <select>
                                    <option>CITY</option>
                                    <option value="">Dhaka</option>
                                    <option value="">Chittagong</option>
                                    <option value="">Sylhet</option>
                                </select>
                                <input type="text" name="zip" placeholder="ZIP">

                                <input type="submit" name="submit" value="SIGN UP" class="signup_submit">

                            </form>
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
