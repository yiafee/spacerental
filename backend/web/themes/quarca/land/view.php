<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Land */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Lands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_sidebar'); ?>

<div class="col-md-9">
    <div class="land-view">
        <p>&nbsp;</p>

        <p>
            <?= Html::a('Unapprove', ['unapprove', 'id' => $model->id], [
                'class' => 'btn btn-danger unapprove'
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
</div>

<?php
    $this->registerJs("
                    $(document).delegate('.unapprove', 'click', function() { 
                        var url = $(this).attr('href');
                        
                        BootstrapDialog.confirm({
                                title: 'WARNING',
                                message: 'Are you sure you want to unapprove it?',
                                type: BootstrapDialog.TYPE_WARNING,
                                closable: false,
                                draggable: true,
                                btnCancelLabel: 'Do not unapprove it!',
                                btnOKLabel: 'Unapprove it!',
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
    ", yii\web\View::POS_END, 'unapprove');
?>