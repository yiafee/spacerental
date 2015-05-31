<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "land_img".
 *
 * @property integer $id
 * @property string $path
 * @property string $title
 * @property string $desc
 * @property string $type
 */
class LandImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'land_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'type', 'land_id', 'user_id'], 'required'],
            [['land_id', 'user_id'],'integer'],
            [['path', 'title', 'desc', 'type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'title' => 'Title',
            'desc' => 'Desc',
            'type' => 'Type',
            'land_id' => 'Land ID'
        ];
    }
}
