
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Food Truck Space';

echo 'welcome to dashboard'.'<br/>';
echo 'Email:   '.\Yii::$app->session->get('user.email').'<br/>';
echo 'Last_access:   '.\Yii::$app->session->get('user.last_access');
	

echo '<p>&nbsp;</p>';
echo '<p>&nbsp;</p>';
echo '<p>&nbsp;</p>';
echo '<li><a href="'.Url::toRoute(['/landowner/profile/']).'">profile</a></li>';

?>

