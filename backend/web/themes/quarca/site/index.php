
<?php
/* @var $this yii\web\View */

$this->title = 'Dashboard';

echo 'welcome to dashboard'.'<br/>';
echo 'Email:   '.\Yii::$app->session->get('user.email').'<br/>';
echo 'Last_access:   '.\Yii::$app->session->get('user.last_access');

?>

