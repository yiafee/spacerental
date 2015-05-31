<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use frontend\models\User;
use frontend\models\Message;

$this->title = 'Sent';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    $cover_photo = \Yii::$app->session->get('f_user.cover_photo');
    if(!empty($cover_photo)){
?>
    
    <style type="text/css">
        .main_banner_bg{
            background: url("<?= Url::base('').'/'.$cover_photo; ?>") no-repeat;
            -moz-background-size: cover;
            -webkit-background-size: cover;
            -ms-background-size: cover;
            background-size: cover;
        }
    </style>

<?php
    }
?>



<?php echo $this->render('/landowner/_top_part'); ?>


<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">


                <div class="col-md-12">
                    <div class="row">
                        
                            <div class="col-md-3">
                                <div class="side_nav_cont side_nav_cont_inner">
                                    <ul>
                                        <?php echo $this->render('_side_menu'); ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="row">
                                    <p>&nbsp;</p>

                                    <table class="table no-margin-bottom">
                    
					                    <tbody class="list">
					                        <tr>
					                            <td colspan="4">
					                                <input type="checkbox" class="check_all" name="check_all" style="float:left;">
					                                <div class="btn_panel_mail text-right">
					                                    <button class="btn btn-default btn-icon btn-sm trash_btn" type="button">
					                                        <span class="icon"><span class="glyphicon glyphicon-trash" title="Trash"></span></span>
					                                    </button>
					                                </div>
					                            </td>
					                        </tr>

					                        <?php
					                        	if(!empty($data)){
					                            	foreach ($data as $key) {
					                        ?>

					                            <tr id="mail_row_<?=$key->id;?>">
					                                <td><input type="checkbox" class="checkbox" name="check" value="<?= $key->id; ?>"></td>
					                                <td><?php 
					                                        echo '<a href="'.Url::toRoute(['/mail/v','id'=>$key->id]).'">';
					                                            echo $key->to_user->first_name; 
					                                            
					                                        echo '</a>';
					                                    ?>
					                                </td>
					                                <td><?= Message::limit_str(80,'<strong>'.$key->subject.'</strong> - '.strip_tags($key->message)); ?></td>
					                                <td><?= date_format(date_create($key->created_at), "F j, Y, g:i a"); ?></td>
					                            </tr>

					                        <?php
					                            	}
					                            }else{
						                            echo '<tr><td colspan="4">Sorry no items.</td></tr>';
						                        }
					                        ?>
					                        


					                    </tbody>
					                </table>

                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                
                            </div>


                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

<?php
	$this->registerJs("
            $('.check_all').click(function() {
                if($(this).is(':checked')) {
                    $('.checkbox').each(function() { 
                        this.checked = true;              
                    });
                } else {
                    $('.checkbox').each(function() { 
                        this.checked = false;              
                    });
                }
            });
    ", yii\web\View::POS_END, 'check_uncheck_all');


    $this->registerJs("
                    $(document).delegate('.trash_btn', 'click', function() { 
                        
                        var checkboxValues = [];
                        $('.checkbox:checked').map(function() {
                            checkboxValues.push($(this).val());
                        });

                        $.ajax({
                                url: '".Url::toRoute(['/message/trash_item'])."',
                                type: 'post',
                                data: {data:checkboxValues},
                                beforeSend : function( request ){
                                    
                                },
                                success: function(data) {
                                    dt = jQuery.parseJSON(data);

                                    if(dt.result=='success'){
                                        $.each(checkboxValues,function(key, value){
                                            $('#mail_row_'+value).remove();
                                        });
                                    }else{
                                        
                                        //alertify.log(dt.files, 'error', 5000);
                                    }

                                }
                        });
                    });
    ", yii\web\View::POS_END, 'trash');
?>