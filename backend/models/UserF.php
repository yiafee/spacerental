<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_f".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $city
 * @property integer $zip
 * @property string $country
 * @property string $gender
 * @property string $password
 * @property string $date_of_birth
 * @property string $auth_key
 * @property integer $status
 * @property integer $reg_status
 * @property string $login_type
 */
class UserF extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_f';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'status'], 'required'],
            [['zip', 'status', 'reg_status'], 'integer'],
            [['date_of_birth'], 'safe'],
            [['first_name', 'last_name', 'city', 'country', 'gender', 'password', 'auth_key', 'login_type'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
            [['email'],'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'city' => 'City',
            'zip' => 'Zip',
            'country' => 'Country',
            'gender' => 'Gender',
            'password' => 'Password',
            'date_of_birth' => 'Date Of Birth',
            'auth_key' => 'Auth Key',
            'status' => 'Status',
            'reg_status' => 'Registration Status',
            'login_type' => 'Login Type',
        ];
    }
}
