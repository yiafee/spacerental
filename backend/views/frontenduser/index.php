<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserFSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Fs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-f-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User F', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'email:email',
            'phone',
            // 'city',
            // 'zip',
            // 'country',
            // 'gender',
            // 'password',
            // 'date_of_birth',
            // 'auth_key',
            // 'status',
            // 'reg_status',
            // 'login_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
