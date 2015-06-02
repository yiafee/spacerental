<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "land_info".
 *
 * @property integer $id
 * @property string $title
 * @property string $address
 * @property string $short_desc
 * @property string $power_source
 * @property string $public_restroom
 * @property string $property_type
 * @property string $property_size
 * @property double $latitude
 * @property double $longitude
 * @property string $street_address
 * @property integer $status
 * @property integer $user_id
 */
class Land extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'land_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'address', 'short_desc', 'power_source', 'public_restroom', 'property_type', 'property_size', 'street_address', 'status', 'user_id'], 'required'],
            [['address', 'short_desc', 'street_address'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['status', 'user_id'], 'integer'],
            [['title', 'power_source', 'public_restroom', 'property_type', 'property_size'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'address' => 'Address',
            'short_desc' => 'Short Desc',
            'power_source' => 'Power Source',
            'public_restroom' => 'Public Restroom',
            'property_type' => 'Property Type',
            'property_size' => 'Property Size',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'street_address' => 'Street Address',
            'status' => 'Status',
            'user_id' => 'User ID',
        ];
    }
}
