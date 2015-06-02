<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserF */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Landowner/Operator', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_sidebar'); ?>

<div class="col-md-9">
    <div class="user-f-view">
        <p>&nbsp;</p>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'first_name',
                'last_name',
                'email:email',
                'phone',
                'city',
                'zip',
                'country',
                'gender',
                //'password',
                'date_of_birth',
                //'auth_key',
                'status',
                'reg_status',
                //'login_type',
            ],
        ]) ?>

    </div>
</div>