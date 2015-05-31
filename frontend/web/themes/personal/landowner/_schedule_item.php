<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="sc_no_<?= $model->id; ?>" target_item="<?php echo $target; ?>">
    <p><?= date('h:i A', strtotime($model->start_time)); ?> - <?= date('h:i A', strtotime($model->end_time)); ?></p>
    <p>$<?= $model->price; ?></p>
    <div class="schedule_menu"></div>

    <div class="pp">
        <div class="pp_left">
            <p><?= date('h:i A', strtotime($model->start_time)); ?> - <?= date('h:i A', strtotime($model->end_time)); ?></p>
            <p>$<?= $model->price; ?></p>
        </div>
        <div class="pp_right">
            <div class="schedule_menu2"></div>
            <ul>
                <li><a href="<?= $model->id; ?>" class="sc_delete"><span class="glyphicon glyphicon-trash"></span></a></li>
                <li><a href="<?= $model->id; ?>" class="sc_update"><span class="glyphicon glyphicon-pencil"></span></a></li>
            </ul>
        </div>
    </div>
</div>