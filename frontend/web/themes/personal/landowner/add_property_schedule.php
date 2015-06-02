<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;


$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile("//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?= Url::base(''); ?>/css/slick-theme.css"/>

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



<?php echo $this->render('_top_part'); ?>


<div class="modal fade" id="add_schedule"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="float:left; width:100%;">
          
          <div class="modal-body" style="float:left; width:100%;">

            <div class="col-md-12">
                    <h4>ADD SCHEDULE</h4>
                    <p>&nbsp;</p>
                <div class="row">

                    <?php $form = ActiveForm::begin(['id' => 'add_schedule_form']); ?>
                        <div class="col-md-6">

                            <input type="hidden" name="LandShedule[land_id]" value="<?= $model->id; ?>">
                            <input type="hidden" name="LandShedule[day]" class="land_day" value="">
                            <input type="hidden" name="LandShedule[target]" class="sc_target" value="">
                            <?= $form->field($LandShedule, 'start_time')
                                ->dropDownList(
                                    [
                                        '01'=>'1:00 AM',
                                        '02'=>'2:00 AM',
                                        '03'=>'3:00 AM',
                                        '04'=>'4:00 AM',
                                        '05'=>'5:00 AM',
                                        '06'=>'6:00 AM',
                                        '07'=>'7:00 AM',
                                        '08'=>'8:00 AM',
                                        '09'=>'9:00 AM',
                                        '10'=>'10:00 AM',
                                        '11'=>'11:00 AM',
                                        '12'=>'12:00 PM',
                                        '13'=>'1:00 PM',
                                        '14'=>'2:00 PM',
                                        '15'=>'3:00 PM',
                                        '16'=>'4:00 PM',
                                        '17'=>'5:00 PM',
                                        '18'=>'6:00 PM',
                                        '19'=>'7:00 PM',
                                        '20'=>'8:00 PM',
                                        '21'=>'9:00 PM',
                                        '22'=>'10:00 PM',
                                        '23'=>'11:00 PM',
                                        '24'=>'12:00 AM',
                                    ],
                                    ['prompt'=>'Start time']
                                );?>


                            <?= $form->field($LandShedule, 'price')->textInput(['maxlength' => 255]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($LandShedule, 'end_time')
                                ->dropDownList(
                                    [
                                        '01'=>'1:00 AM',
                                        '02'=>'2:00 AM',
                                        '03'=>'3:00 AM',
                                        '04'=>'4:00 AM',
                                        '05'=>'5:00 AM',
                                        '06'=>'6:00 AM',
                                        '07'=>'7:00 AM',
                                        '08'=>'8:00 AM',
                                        '09'=>'9:00 AM',
                                        '10'=>'10:00 AM',
                                        '11'=>'11:00 AM',
                                        '12'=>'12:00 PM',
                                        '13'=>'1:00 PM',
                                        '14'=>'2:00 PM',
                                        '15'=>'3:00 PM',
                                        '16'=>'4:00 PM',
                                        '17'=>'5:00 PM',
                                        '18'=>'6:00 PM',
                                        '19'=>'7:00 PM',
                                        '20'=>'8:00 PM',
                                        '21'=>'9:00 PM',
                                        '22'=>'10:00 PM',
                                        '23'=>'11:00 PM',
                                        '24'=>'12:00 AM',
                                    ],
                                    ['prompt'=>'End time']
                                );?>

                                <div class="form-group save_continue">
                                    <?= Html::submitButton('Add', ['class' =>'btn btn-primary add_schedule_btn']) ?>
                                </div>
                        </div>

                    <?php ActiveForm::end(); ?>

                    <div class="has-error">
                        <p class="help-block help-block-error error_schedule"></p>
                    </div>
                </div>
            </div>


            

          </div>
          
        </div>
    </div>
</div>


<div class="modal fade" id="update_schedule"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="float:left; width:100%;">
          
          <div class="modal-body" style="float:left; width:100%;">

          </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">


                <div class="col-md-12">
                    <div class="row">
                        
                            <div class="col-md-3">
                                <div class="side_nav_cont side_nav_cont_inner">
                                    <ul>
                                        <li><a class="<?php echo (Yii::$app->controller->action->id=='viewproperty')?'active':''; ?>" href="<?php echo Url::toRoute(['/landowner/viewproperty/','id'=>$model->id,'title'=>$model->title]); ?>">Property Basic Info</a></li>
                                        <li><a class="<?php echo (Yii::$app->controller->action->id=='add_property_image')?'active':''; ?>" href="<?php echo Url::toRoute(['/landowner/add_property_image/','id'=>$model->id,'title'=>$model->title]); ?>">Property Images</a></li>
                                        <li><a class="<?php echo (Yii::$app->controller->action->id=='add_property_schedule')?'active':''; ?>" href="<?php echo Url::toRoute(['/landowner/add_property_schedule/','id'=>$model->id,'title'=>$model->title]); ?>">Property Schedule</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="row">
                                

                                    <div class="col-md-12">
                                        <h4>ADD SCHEDULE</h4>
                                    </div>

                                    <div class="schedule_boxes">

                                    <?php
                                        $day_array = array(
                                                '1'=>'SATURDAY',
                                                '2'=>'SUNDAY',
                                                '3'=>'MONDAY',
                                                '4'=>'TUESDAY',
                                                '5'=>'WEDNESDAY',
                                                '6'=>'THURSDAY',
                                                '7'=>'FRIDAY',
                                            );

                                        foreach ($day_array as $index_no => $value) {
                                    ?>


                                        <div class="col-md-12">
                                            <div class="row">

                                                <div class="schedule_day">
                                                    <div class="col-md-2 day_name">
                                                        <?= $value; ?>
                                                        <span target="slick<?= $index_no; ?>" day="<?= $value; ?>" class="add_item">+</span>
                                                    </div>
                                                    <div class="col-md-10 sc_box">
                                                        <div class="row">
                                                            
                                                            <div class="slick slick<?= $index_no; ?>">

                                                                <?php
                                                                    if(!empty($all_schedule)){
                                                                        foreach ($all_schedule as $key) {
                                                                            if($key->day== $value ){
                                                                ?>
                                                                    <div class="sc_no_<?= $key->id; ?>" target_item="slick<?= $index_no; ?>">
                                                                        <p><?= date('h:i A', strtotime($key->start_time)); ?> - <?= date('h:i A', strtotime($key->end_time)); ?></p>
                                                                        <p>$<?= $key->price; ?></p>

                                                                        <div class="schedule_menu"></div>

                                                                        <div class="pp">
                                                                            <div class="pp_left">
                                                                                <p><?= date('h:i A', strtotime($key->start_time)); ?> - <?= date('h:i A', strtotime($key->end_time)); ?></p>
                                                                                <p>$<?= $key->price; ?></p>
                                                                            </div>
                                                                            <div class="pp_right">
                                                                                <div class="schedule_menu2"></div>
                                                                                <ul>
                                                                                    <li><a href="<?= $key->id; ?>" class="sc_delete"><span class="glyphicon glyphicon-trash"></span></a></li>
                                                                                    <li><a href="<?= $key->id; ?>" class="sc_update"><span class="glyphicon glyphicon-pencil"></span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                                

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    <?php
                                        }
                                    ?>
                                        




                                    </div>


                                </div>
                            </div>
                        

                    </div>
                </div>



            </div>
        </div>
    </div>
</div>





<div class="padding_btm_60"></div>

<div class="container-fluid footer_find">
    <div class="row">
        <p><a href="#">FIND OUT HOT SPACES AROUND YOU</a></p>
    </div>
</div> 



<?php
    $this->registerJs("
        $('.slick').css('width',(parseInt($('.sc_box').css('width'))-50)+'px');
        $(window).resize(function(){
            $('.slick').css('width',(parseInt($('.sc_box').css('width'))-50)+'px');
        });

        $('.slick').slick({
          dots: false,
          infinite: false,
          speed: 300,
          slidesToShow: 4,
          slidesToScroll: 4,
          responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });

        $('.add_item').on('click',function(){
            var day = $(this).attr('day');
            var target = $(this).attr('target');


            $('.land_day').val(day);
            $('#add_schedule').modal('show');

            $('.sc_target').val(target);


            //var target = $(this).attr('target');
            //var length = $('.'+target+' .slick-slide').length;

            //$('.'+target).slick('slickAdd','<div>dadasd</div>');
        });

        
        $('.add_schedule_btn').on('click',function(){
            

            if($('#landshedule-start_time').val()==''){
                $('.field-landshedule-start_time').addClass('has-error');
                $('.field-landshedule-start_time .help-block').html('Start Time can not be blank.');
                return false;
            }else{
                $('.field-landshedule-start_time').removeClass('has-error');
                $('.field-landshedule-start_time .help-block').html('');
            }

            if($('#landshedule-end_time').val()==''){
                $('.field-landshedule-end_time').addClass('has-error');
                $('.field-landshedule-end_time .help-block').html('End Time can not be blank.');
                return false;
            }else{
                $('.field-landshedule-end_time').removeClass('has-error');
                $('.field-landshedule-end_time .help-block').html('');
            }

            var valid = checktime();
            if(valid=='success'){
                $('.error_schedule').html('');
            }else{
                $('.error_schedule').html(valid);
                return false;
            }

            if($('#landshedule-price').val()==''){
                $('.field-landshedule-price').addClass('has-error');
                $('.field-landshedule-price .help-block').html('Price can not be blank.');
                return false;
            }else{
                $('.field-landshedule-price').removeClass('has-error');
                $('.field-landshedule-price .help-block').html('');
            }

            var data = $('#add_schedule_form').serialize();

            $.ajax({
                type : 'POST',
                dataType : 'json',
                url : '".Url::toRoute('landowner/add_schedule')."',
                data: data,
                beforeSend : function( request ){
                   
                },
                success : function( data ){ 
                    if(data.result=='success'){

                        var target = $('.sc_target').val();

                        $('.'+target).slick('slickAdd',data.view);
                        $('#add_schedule').modal('hide');
                    }else{
                        $('.error_schedule').html(data.errors);
                    }
                }
            });


            return false;
        });

        function checktime(){
            var start_time = $('#landshedule-start_time').val();
            var end_time = $('#landshedule-end_time').val();

           /* var stt = new Date('November 13, 2013 ' + start_time);
            stt = stt.getTime();

            var endt = new Date('November 13, 2013 ' + end_time);
            endt = endt.getTime();*/

            if(start_time > end_time) {
                return 'Start time can not be greater than end time.';
            }else{
                return 'success';
            }

        }




        /*$(document).delegate('.schedule_menu','click',function(){

            if($(this).hasClass('open')){
                $(this).find('ul').hide();
                $(this).removeClass('open');
            }else{
                $('.schedule_menu').find('ul').hide();
                $('.schedule_menu').removeClass('open');

                $(this).find('ul').show();
                $(this).addClass('open');
            }
        });*/
    ", yii\web\View::POS_READY, 'slider');

    
    
    $this->registerJs("

        $(document).delegate('.sc_delete','click',function(){
            var id = $(this).attr('href');

            BootstrapDialog.confirm({
                                title: 'WARNING',
                                message: 'Are you sure?',
                                type: BootstrapDialog.TYPE_WARNING,
                                closable: false,
                                draggable: true,
                                btnCancelLabel: 'Do not delete it!',
                                btnOKLabel: 'Delete it!',
                                callback: function(result) {
                                    if(result) {
                                        $.ajax({
                                            type : 'POST',
                                            dataType : 'json',
                                            url : '".Url::toRoute('landowner/remove_schedule')."',
                                            data: {id:id},
                                            beforeSend : function( request ){
                                               
                                            },
                                            success : function( data ){ 
                                                if(data.result=='success'){

                                                    var index = $('.sc_no_'+id).attr('data-slick-index');
                                                    var target_remove = $('.sc_no_'+id).attr('target_item')

                                                    $('.'+target_remove).slick('slickRemove',index);
                                                    $('.'+target_remove).slick('unslick');
                                                    $('.'+target_remove).slick({
                                                          dots: false,
                                                          infinite: false,
                                                          speed: 300,
                                                          slidesToShow: 4,
                                                          slidesToScroll: 4,
                                                          responsive: [
                                                            {
                                                              breakpoint: 1200,
                                                              settings: {
                                                                slidesToShow: 3,
                                                                slidesToScroll: 3
                                                              }
                                                            },
                                                            {
                                                              breakpoint: 600,
                                                              settings: {
                                                                slidesToShow: 2,
                                                                slidesToScroll: 2
                                                              }
                                                            },
                                                            {
                                                              breakpoint: 480,
                                                              settings: {
                                                                slidesToShow: 1,
                                                                slidesToScroll: 1
                                                              }
                                                            }
                                                          ]
                                                        });


                                                }else{
                                                    alert(data.errors);
                                                }
                                            }
                                        });
                                    }else {
                                        
                                    }
                                }
                        });

            

            return false;
        });

    ", yii\web\View::POS_READY, 'delete_schedule');



    $this->registerJs("
        $(document).delegate('.schedule_menu','click',function(){
            $('.pp').hide();
            $('.pp').css({'width':'100%','left':'-1px'});

            

            if($(this).parent().next('div').length > 0){
                $(this).next('.pp').show();
                $(this).next('.pp').animate({'width':'120%'},200);
            }else{
                $(this).next('.pp').show();
                $(this).next('.pp').animate({'width':'120%','left':'-30px'},200);
            }
        });

        $(document).delegate('.schedule_menu2','click',function(){
            $(this).parent().parent().animate({'left':'-1px','width':'100%'},200,function(){
                $(this).hide();
            });
            
        });

        $(document).delegate('.sc_update','click',function(){
            var id = $(this).attr('href');
            var target = $('.sc_no_'+id).attr('target_item');

            $.ajax({
                type : 'POST',
                dataType : 'json',
                url : '".Url::toRoute('landowner/update_schedule_form')."',
                data: {id:id,target:target},
                beforeSend : function( request ){
                   
                },
                success : function( data ){ 
                    if(data.result=='success'){

                        $('#update_schedule .modal-body').html(data.view);
                        $('#update_schedule').modal('show');
                        
                    }else{
                        alert(data.errors);
                    }
                }
            });

            return false;
        });

    ", yii\web\View::POS_READY, 'update_schedule_modal');



    $this->registerJs("

        $(document).delegate('.update_schedule_btn','click',function(){
            var data = $('#update_schedule_form').serialize();

            $.ajax({
                type : 'POST',
                dataType : 'json',
                url : '".Url::toRoute('landowner/update_schedule')."',
                data: data,
                beforeSend : function( request ){
                   
                },
                success : function( data ){ 
                    if(data.result=='success'){

                        $('.sc_no_'+data.schedule_id+' p:first-child').html(data.time);
                        $('.sc_no_'+data.schedule_id+' p:nth-child(2)').html(data.price);

                        $('#update_schedule .modal-body').html('');
                        $('#update_schedule').modal('hide');
                    }else{
                        $('.error_schedule_update').html(data.errors);
                    }
                }
            });

            return false;
        });

    ", yii\web\View::POS_READY, 'update_schedule');
    

?>
