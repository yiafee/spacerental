<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\UserF */

$this->title = 'Create User F';
$this->params['breadcrumbs'][] = ['label' => 'User Fs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-f-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
