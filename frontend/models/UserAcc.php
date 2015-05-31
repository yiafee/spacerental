<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_acc".
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $value
 */
class UserAcc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_acc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name', 'value', 'user_id'], 'required'],
            [['type', 'name', 'value'], 'string', 'max' => 255],
            [['user_id'],'integer'],
            [['value'], 'unique', 'targetAttribute' => ['type', 'name', 'value'], 'message'=>'Given information is already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Account Name',
            'value' => 'Account No',
        ];
    }
}
