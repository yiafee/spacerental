<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property integer $from
 * @property integer $to
 * @property string $type
 * @property string $subject
 * @property string $message
 * @property string $created_at
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }



    public function rules()
    {
        return [
            [['from', 'to', 'type', 'subject', 'message', 'trash'], 'required'],
            [['from', 'to', 'trash'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['type'], 'string', 'max' => 50],
            [['subject'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'type' => 'Type',
            'subject' => 'Subject',
            'message' => 'Message',
            'created_at' => 'Created At',
        ];
    }


    public function getTo_user()
    {
        return $this->hasOne(User::className(), ['id' => 'to']);
    }


    public static function limit_str($length, $string){
        $charset = 'UTF-8';
        if(mb_strlen($string, $charset) > $length) {
            $string = mb_substr($string, 0, $length - 3, $charset) . ' ...';
        }

        return $string;
    }


}
