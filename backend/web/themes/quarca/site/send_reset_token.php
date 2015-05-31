<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>&nbsp;</p>
<p>We will help you to reset your password. Enter your registered email address.</p>


<?php $form = ActiveForm::begin(['id' => 'form-reset']); ?>
    <?= $form->field($model, 'email')->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>

<?php
    if(Yii::$app->session->hasFlash('success')){
        echo '<p>&nbsp;</p>';
        echo '<p class="success">'.Yii::$app->session->getFlash('success').'</p>';
    }
?>