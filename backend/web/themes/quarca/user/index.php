<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;


$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('sidebar'); ?>

<div class="col-md-9">
    <div class="user-index">
        <p>&nbsp;</p>
        <p>
            <?= Html::a('Create User', ['create'], ['class' => 'btn btn-default']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                /*['class' => 'yii\grid\SerialColumn'],*/

                'id',
                'name',
                'email:email',
                'username',
                //'password',
                // 'auth_key',
                // 'password_reset_token',
                // 'status',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
</div>

