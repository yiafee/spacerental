<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Land */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Lands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="land-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'title',
            'address:ntext',
            'short_desc:ntext',
            'power_source',
            'public_restroom',
            'property_type',
            'property_size',
            'latitude',
            'longitude',
            'street_address:ntext',
            'status',
            'user_id',
        ],
    ]) ?>

</div>
