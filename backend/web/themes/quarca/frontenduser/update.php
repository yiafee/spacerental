<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserF */

$this->title = 'Update Landowner/Operator' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Landowner/Operator', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('_sidebar'); ?>

<div class="col-md-9">
	<div class="row">
		<div class="user-f-update">

		    <div class="col-md-12">
		    	<h4><?= Html::encode($this->title) ?></h4>
		    </div>

		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>

		</div>
	</div>
</div>
