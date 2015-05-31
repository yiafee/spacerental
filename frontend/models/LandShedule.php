<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "land_shedule".
 *
 * @property integer $id
 * @property string $day
 * @property string $start_time
 * @property string $end_time
 * @property double $price
 * @property integer $land_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class LandShedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'land_shedule';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    public $target;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['day', 'start_time', 'end_time', 'price', 'land_id', 'status', 'user_id'], 'required','on'=>'insert'],
            [['price'], 'number'],
            [['land_id', 'status'], 'integer'],
            [['created_at', 'updated_at','target','id'], 'safe'],
            [['day', 'start_time', 'end_time'], 'string', 'max' => 255],
            ['start_time', 'check_time','on'=>'insert'],

            [['start_time', 'end_time', 'price'], 'required','on'=>'update'],
            ['start_time', 'check_time_update','on'=>'update'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day' => 'Day',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'price' => 'Price',
            'land_id' => 'Land ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }


    public function check_time($attribute, $params)
    {
        if($this->start_time > $this->end_time){
            $this->addError($attribute, 'Start time can not be greater than end time.');
        }elseif($this->start_time == $this->end_time){
            $this->addError($attribute, 'Start time can not be equal to end time.');
        }else{

            $data = Yii::$app->db->createCommand('SELECT * from `land_shedule` where 
                    ((time("'.$this->start_time.'") >= time(`start_time`) and time("'.$this->start_time.'") < time(`end_time`)) || 
                    (time("'.$this->end_time.'") > time(`start_time`) and time("'.$this->end_time.'") <= time(`end_time`)) || 
                    (time("'.$this->start_time.'") = time(`start_time`) and time("'.$this->end_time.'") = time(`end_time`))) and
                    ("'.$this->day.'" = `day` and "'.$this->land_id.'" = `land_id`)' )
                ->queryAll();

            if(!empty($data)){
                $html = 'Your slots are ';
                $i = 0;
                $all_data = Yii::$app->db->createCommand('SELECT * from `land_shedule` where 
                                ("'.$this->day.'" = `day` and "'.$this->land_id.'" = `land_id`)' )
                            ->queryAll();

                foreach ($all_data as $key) {
                    if($i!=0){$html.=' ,';}

                    $html.= date('h:i A', strtotime($key['start_time'])).' - '.date('h:i A', strtotime($key['end_time'])).' ';
                    
                    $i++;
                }
                $this->addError($attribute, 'Invalid time slot. '.$html);
            }
        }
        
    }




    public function check_time_update($attribute, $params)
    {
        if($this->start_time > $this->end_time){
            $this->addError($attribute, 'Start time can not be greater than end time.');
        }elseif($this->start_time == $this->end_time){
            $this->addError($attribute, 'Start time can not be equal to end time.');
        }else{

            $data = Yii::$app->db->createCommand('SELECT * from `land_shedule` where 
                    ((time("'.$this->start_time.'") >= time(`start_time`) and time("'.$this->start_time.'") < time(`end_time`)) || 
                    (time("'.$this->end_time.'") > time(`start_time`) and time("'.$this->end_time.'") <= time(`end_time`)) || 
                    (time("'.$this->start_time.'") = time(`start_time`) and time("'.$this->end_time.'") = time(`end_time`))) and
                    ("'.$this->day.'" = `day` and "'.$this->land_id.'" = `land_id` and "'.$this->id.'" != `id`)' )
                ->queryAll();

            if(!empty($data)){
                $html = 'Your slots are ';
                $i = 0;
                $all_data = Yii::$app->db->createCommand('SELECT * from `land_shedule` where 
                                ("'.$this->day.'" = `day` and "'.$this->land_id.'" = `land_id` and "'.$this->id.'" != `id`)' )
                            ->queryAll();

                foreach ($all_data as $key) {
                    if($i!=0){$html.=' ,';}

                    $html.= date('h:i A', strtotime($key['start_time'])).' - '.date('h:i A', strtotime($key['end_time'])).' ';
                    
                    $i++;
                }
                $this->addError($attribute, 'Invalid time slot. '.$html);
            }
        }
        
    }



}
