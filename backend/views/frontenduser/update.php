<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserF */

$this->title = 'Update User F: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Fs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-f-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
