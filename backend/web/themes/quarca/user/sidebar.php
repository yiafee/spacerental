<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="col-md-3">
    <p>&nbsp;</p>
    <ul class="side_menu">

        <li class="<?php echo (Yii::$app->controller->id=='user' && Yii::$app->controller->action->id=='index')?'active':''; ?>">
            <a href="<?= Url::toRoute(['/user/index']); ?>">Manage User</a>
        </li>

        <li class="<?php echo (Yii::$app->controller->id=='user' && Yii::$app->controller->action->id=='create')?'active':''; ?>">
            <a href="<?= Url::toRoute(['/user/create']); ?>">Create User</a>
        </li>

        <li class="<?php echo (Yii::$app->controller->id=='user' && Yii::$app->controller->action->id=='change_password')?'active':''; ?>">
            <a href="<?= Url::toRoute(['/user/change_password']); ?>">Change Password</a>
        </li>

    </ul>
</div>