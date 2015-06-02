<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserFSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unapproved Landowner/Operator';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_sidebar'); ?>

<div class="col-md-9">
    <div class="user-f-index">
        <p>&nbsp;</p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                /*['class' => 'yii\grid\SerialColumn'],*/

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
                'status',
                // 'reg_status',
                // 'login_type',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {approve}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                        'title' => 'Update',                                  
                            ]);
                        },
                        'approve' => function ($url, $model) {
                            return Html::a('<span class="fa fa-search"></span>Approve', $url, [
                                        'title' => 'Approve', 
                                        'class' => 'approve'                                 
                            ]);
                        },
                    ],

                ],
            ],
        ]); ?>

    </div>
</div>


<?php
    $this->registerJs("
                    $(document).delegate('.approve', 'click', function() { 
                        var url = $(this).attr('href');
                        
                        BootstrapDialog.confirm({
                                title: 'WARNING',
                                message: 'Are you sure you want to approve it?',
                                type: BootstrapDialog.TYPE_WARNING,
                                closable: false,
                                draggable: true,
                                btnCancelLabel: 'Do not approve it!',
                                btnOKLabel: 'Approve it!',
                                callback: function(result) {
                                    if(result) {
                                        window.location = url;
                                    }else {
                                        return false;
                                    }
                                }
                        });

                        return false;
                        
                    });
    ", yii\web\View::POS_END, 'approve');
?>