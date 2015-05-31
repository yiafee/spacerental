<?php

namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user_f".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $date_of_birth
 * @property string $auth_key
 * @property integer $status
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    
    private $_user = false;
    public $rememberMe = true;
    private static $users = [];



    public $business_name;
    public $day;
    public $month;
    public $year;

    public $logged_in_type;


    public $repeat_password;
    public $old_password;
    public $new_password;
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
            [['first_name', 'last_name', 'email', 'city', 'zip', 'password', 'status', 'auth_key'], 'required','on'=>'insert'],
            [['date_of_birth'], 'safe','on'=>'insert'],
            [['status', 'zip', 'reg_status'], 'integer'],
            [['first_name', 'last_name', 'city', 'password', 'auth_key', 'gender', 'country'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],

            [['first_name', 'last_name', 'email', 'city', 'zip', 'gender', 'country', 'day', 'month', 'year'], 'required','on'=>'personal_info'],
            ['date_of_birth', 'checkdate', 'on' => 'personal_info'],

            [['repeat_password', 'old_password', 'new_password'], 'required' , 'on' => 'change_password'],
            ['repeat_password', 'compare', 'compareAttribute'=>'new_password','on'=>'change_password'],
            ['old_password', 'findPasswords', 'on' => 'change_password'],
        ];
    }

    public function findPasswords($attribute, $params)
    {
        $user = self::find()->where(['id'=>\Yii::$app->user->identity->id])->one();

        if (!$user->validatePassword($this->old_password)){
            $this->addError($attribute, 'Old Password Invalid.');
        }else{
            $this->clearErrors($attribute);
        }
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
            'zip' => 'Zip Code',
            'country' => 'Country',
            'gender' => 'Gender',
            'password' => 'Password',
            'date_of_birth' => 'Date Of Birth',
            'auth_key' => 'Auth Token',
            'status' => 'Status',
            'business_name' => 'Business Name (if applicable)',
            'day'=>'Day',
            'month' => 'Month',
            'year' => 'Year'
        ];
    }

    public function checkdate($attribute, $params)
    {
        if(!checkdate($this->month, $this->day, $this->year)){
            $this->addError($attribute, 'Date of birth is Invalid.');
        }else{
            $this->clearErrors($attribute);
        }
    }


        /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
        
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
 

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }



    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }


    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    public function getYears($start,$year){
        $options = [];

        for($i=0;$i<=$year;$i++){
            $options[$start-$i] = $start-$i;
        }

        return $options;
    }


    public function getUserlist(){
        $options = [];

        $data = User::find()->where('id != :id',[':id'=>\Yii::$app->user->identity->id])->all();

        foreach ($data as $key) {
            $options[$key->id] = $key->email;
        }

        return $options;
    }


}
