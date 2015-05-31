<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $password_reset_token
 * @property integer $status
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $repeat_password;
    public $old_password;
    public $new_password;


    public static function tableName()
    {
        return 'user';
    }

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

   
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'status'], 'required'],
            [['status'], 'integer'],
            [['name', 'email', 'username', 'password', 'password_reset_token', 'last_access', 'image'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'],'unique'],
            [['email'],'email'],

            [['repeat_password', 'old_password', 'new_password'], 'required' , 'on' => 'change_password'],
            ['repeat_password', 'compare', 'compareAttribute'=>'new_password','on'=>'change_password'],
            ['old_password', 'findPasswords', 'on' => 'change_password'],
        ];
    }

  
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'image' => 'Image',
        ];
    }

    public function findPasswords($attribute, $params)
    {
        $user = self::find()->where(['id'=>\Yii::$app->session->get('user.id')])->one();

        if (!$user->validatePassword($this->old_password)){
            $this->addError($attribute, 'Old Password Invalid.');
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


}
