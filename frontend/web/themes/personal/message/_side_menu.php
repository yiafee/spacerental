<?php
use yii\helpers\Html;
use yii\helpers\Url;


?>

<ul>
    <li><a class="<?php echo (Yii::$app->controller->action->id=='compose')?'active':''; ?>" href="<?php echo Url::toRoute(['/message/compose/']); ?>">Compose</a></li>
    <li><a class="<?php echo (Yii::$app->controller->action->id=='inbox')?'active':''; ?>" href="<?php echo Url::toRoute(['/message/inbox/']); ?>">Inbox</a></li>
    <li><a class="<?php echo (Yii::$app->controller->action->id=='sent')?'active':''; ?>" href="<?php echo Url::toRoute(['/message/sent/']); ?>">Sent</a></li>
    <li><a class="<?php echo (Yii::$app->controller->action->id=='trash')?'active':''; ?>" href="<?php echo Url::toRoute(['/message/trash/']); ?>">Trash</a></li>
</ul>