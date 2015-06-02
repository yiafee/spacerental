<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="col-md-3">
    <p>&nbsp;</p>
    <ul class="side_menu">

        <li class="<?php echo (Yii::$app->controller->id=='land' && Yii::$app->controller->action->id=='index')?'active':''; ?>">
            <a href="<?= Url::toRoute(['/land/index']); ?>">Manage Lands</a>
        </li>

        <li class="<?php echo (Yii::$app->controller->id=='land' && Yii::$app->controller->action->id=='unapproved')?'active':''; ?>">
            <a href="<?= Url::toRoute(['/land/unapproved']); ?>">Unapproved Lands</a>
        </li>

    </ul>
</div>