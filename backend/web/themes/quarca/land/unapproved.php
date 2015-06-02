<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unapproved Lands';
$this->params['breadcrumbs'][] = $this->title;


?>

<?= $this->render('_sidebar'); ?>

<div class="col-md-9">
	<div class="land-index">
		<p>&nbsp;</p>

		<?php \yii\widgets\Pjax::begin(); ?>

	    <?= GridView::widget([
	        'dataProvider' => $dataProvider,
	        'filterModel' => $searchModel,
	        'columns' => [
	            /*['class' => 'yii\grid\SerialColumn'],*/

	            'id',
	            'title',
	            'address:ntext',
	            //'short_desc:ntext',
	            //'power_source',
	            // 'public_restroom',
	            // 'property_type',
	            // 'property_size',
	            // 'latitude',
	            // 'longitude',
	             'street_address:ntext',
	             'status',
	             'user_id',

	            ['class' => 'yii\grid\ActionColumn',
			        'template' => '{update} {approve}',
			        'buttons' => [
			            'update' => function ($url, $model) {
			                return Html::a('<span class="fa fa-search"></span>Update', $url, [
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

	    <?php \yii\widgets\Pjax::end(); ?>

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