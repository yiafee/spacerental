<?php

namespace app\components;

use frontend\models\UserImg;
use yii\helpers\Url;

class GlobalClass extends \yii\base\Component{
    public function init() {
        

        if(isset(\Yii::$app->user->identity)){
	    	$check = \Yii::$app->session->get('f_user.profile_pic');

	    	if(empty($check)){
	    		$type = 'landowner';
	            $cover_q = UserImg::find()->where(['user_id' => \Yii::$app->user->identity->id, 'type'=> 'cover', 'user_type' => $type])->one();
	            if(!empty($cover_q)){
	                $cover_photo = $cover_q->path;
	            }else{
	                $cover_photo = '';
	            }

	            $profile_q = UserImg::find()->where(['user_id' => \Yii::$app->user->identity->id, 'type'=> 'profile', 'user_type' => $type])->one();
	            if(!empty($profile_q)){
	                $profile_photo = $profile_q->path;
	            }else{
	                $profile_photo = '';
	            }


	            \Yii::$app->session->set('f_user.profile_pic',$profile_photo);
	            \Yii::$app->session->set('f_user.cover_photo',$cover_photo);
	    	}


	    	

    	}



        parent::init();
    }
}