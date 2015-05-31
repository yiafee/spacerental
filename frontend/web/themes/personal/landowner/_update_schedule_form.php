<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>

<div class="col-md-12">
        <h4>Update SCHEDULE</h4>
        <p>&nbsp;</p>
    <div class="row">

        <?php $form = ActiveForm::begin(['id' => 'update_schedule_form','action' => ['landowner/update_schedule'],]); ?>
            <div class="col-md-6">

                <input type="hidden" name="LandShedule[land_id]" value="<?= $LandShedule->land_id; ?>">
                <input type="hidden" name="LandShedule[day]" class="land_day" value="<?= $LandShedule->day; ?>">
                <input type="hidden" name="LandShedule[target]" class="sc_target" value="<?= $target; ?>">
                <input type="hidden" name="LandShedule[id]" class="sc_id" value="<?= $LandShedule->id; ?>">
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
                        <?= Html::submitButton('Add', ['class' =>'btn btn-primary update_schedule_btn']) ?>
                    </div>
            </div>

        <?php ActiveForm::end(); ?>

        <div class="has-error">
            <p class="help-block help-block-error error_schedule_update"></p>
        </div>
    </div>
</div>
