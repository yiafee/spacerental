<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('sidebar'); ?>

<div class="col-md-9">
	<div class="user-create">

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

	</div>
</div>