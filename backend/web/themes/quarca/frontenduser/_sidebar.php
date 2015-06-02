<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="col-md-3">
    <p>&nbsp;</p>
    <ul class="side_menu">

        <li class="<?php echo (Yii::$app->controller->id=='frontenduser' && Yii::$app->controller->action->id=='index')?'active':''; ?>">
            <a href="<?= Url::toRoute(['/frontenduser/index']); ?>">Approved Landowner/Operator</a>
        </li>

        <li class="<?php echo (Yii::$app->controller->id=='frontenduser' && Yii::$app->controller->action->id=='unapproved')?'active':''; ?>">
            <a href="<?= Url::toRoute(['/frontenduser/unapproved']); ?>">Unapproved Landowner/Operator</a>
        </li>

    </ul>
</div>