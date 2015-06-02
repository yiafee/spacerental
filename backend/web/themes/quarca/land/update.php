<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Land */

$this->title = 'Update Land: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Lands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('_sidebar'); ?>

<div class="col-md-9">
	<div class="land-update">

	    <h3><?= Html::encode($this->title) ?></h3>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

	</div>
</div>
