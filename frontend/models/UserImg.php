<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "user_img".
 *
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property string $type
 * @property string $user_type
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class UserImg extends \yii\db\ActiveRecord
{
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
            ],
        ];
    }


    public static function tableName()
    {
        return 'user_img';
    }

    public $cover_photo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'type', 'user_type', 'user_id'], 'required'],
            [['created_at', 'updated_at'],'safe'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'path', 'type', 'user_type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'path' => 'Path',
            'type' => 'Type',
            'user_type' => 'User Type',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
