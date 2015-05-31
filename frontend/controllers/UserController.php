<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\UserFSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\helpers\Url;

use frontend\models\LoginForm;
use frontend\models\UserImg;
use frontend\models\Resetpassword;
use frontend\models\UserAcc;
use frontend\models\LandInfo;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function beforeAction($action){
        
        $this->getView()->theme = Yii::createObject([
            'class' => '\yii\base\Theme',
            'pathMap' => ['@app/views' => '@app/web/themes/'.Yii::$app->params['frontend.theme']],
            'baseUrl' => '@web/themes/'.Yii::$app->params['frontend.theme'],
        ]);

        return parent::beforeAction($action);
    }


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['personal_info', 'profile_pic', 'upload_pic', 'crop_img', 'payment_method','add_property', 'complete'],
                'rules' => [
                    [
                        'actions' => ['personal_info', 'profile_pic', 'upload_pic', 'crop_img', 'payment_method', 'add_property', 'complete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionSignup()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        $model = new User();
        $model->scenario = 'insert';

        if ($model->load(Yii::$app->request->post())) {
            $model->status = 0;
            $model->auth_key = Yii::$app->security->generateRandomString() . '_' . time();

            $valid = $model->validate();

            if($valid){
                
                $model->save();

                $text = 'Please follow the link to complete your password reset process. ';
                $text .= '<a href="'.Yii::$app->urlManager->createAbsoluteUrl(['/user/confirm_email','token'=>$model->auth_key]).'">Click Here</a>';

                $message = Yii::$app->mailer->compose();

                $message->setFrom(\Yii::$app->params['admin_email']);
                $message->setTo($model->email);
                $message->setSubject("Verification");
                $message->setHtmlBody($text);

                if($message->send()){
                    Yii::$app->session->set('temp_email',$model->email);
                    return $this->redirect(['confirm_email']);
                }


            }else{
                var_dump($model->getErrors());
                exit();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    public function actionConfirm_email($token='', $resend='')
    {


        if(!empty($token)){
            $data = User::find()->where(['auth_key'=>$token])->one();

            if(!empty($data)){
                $password = $data->password;
                $data->password = \Yii::$app->security->generatePasswordHash($data->password);
                $data->auth_key = '';
                $data->status = 1;

                if($data->save()){

                    $data->password = $password;

                    if (\Yii::$app->user->login($data, 3600 * 24 * 30) ) {
                        
                        $verified = 'yes';
                        return $this->render('confirm_email',['verified'=>$verified]);
                    }

                }
            }
        }

        if(!empty($resend)){
            $verified = 'yes';
            return $this->render('confirm_email',['verified'=>$verified]);
        }
        
        $email = Yii::$app->session->get('temp_email');
        return $this->render('confirm_email',['email'=>$email]);
    }

    

    public function actionPersonal_info($type){

        if(($type=='') || (isset(\Yii::$app->user->identity) && (\Yii::$app->user->identity->reg_status==1))){
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model = User::find()->where(['id'=>\Yii::$app->user->identity->id])->one();
        $model->scenario = 'personal_info';

        if(!empty($model->date_of_birth)){
            $date = explode('-', $model->date_of_birth);
            $model->day = $date['2'];
            $model->month = $date['1'];
            $model->year = $date['0'];
        }

        if ($model->load(Yii::$app->request->post())) {
            $valid = $model->validate();

            if($valid){
                $model->date_of_birth = $model->year.'-'.$model->month.'-'.$model->day;
                if($model->save()){
                    $this->redirect(['/user/profile_pic','type'=>$type]);
                }
            }
        }

        return $this->render('personal_info',['model'=>$model,'type'=>$type]);

    }




    public function actionProfile_pic($type){
        if(($type=='') || (isset(\Yii::$app->user->identity) && (\Yii::$app->user->identity->reg_status==1))){
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $profile_pic_q = UserImg::find()->where(['user_id' => \Yii::$app->user->identity->id, 'type'=> 'profile', 'user_type' => $type])->one();
        if(!empty($profile_pic_q)){
            $profile_pic = $profile_pic_q->path;
        }else{
            $profile_pic = '';
        }

        $cover_pic_q = UserImg::find()->where(['user_id' => \Yii::$app->user->identity->id, 'type'=> 'cover', 'user_type' => $type])->one();
        if(!empty($cover_pic_q)){
            $cover_pic = $cover_pic_q->path;
        }else{
            $cover_pic = '';
        }

        $model = new UserImg();

        return $this->render('profile_pic',['model'=> $model, 'type'=>$type, 'profile_pic'=>$profile_pic, 'cover_pic'=>$cover_pic]);
    }


    public function actionUpload_pic($type){
        if( Yii::$app->request->isAjax ){
            $id = $_POST['id'];
            $img_type = $_POST['img_type'];
            $user_type = $type;
            $instance = $_POST['instance'];


            $model = UserImg::find()->where(['user_id' => $id, 'type'=> $img_type, 'user_type' => $user_type])->one();
            if(empty($model)){
                $model = new UserImg();
                $model->type = $img_type;
                $model->user_type = $user_type;
                $model->user_id = $id;
            }

            $prev_img = $model->path;

            $uploaded_image = UploadedFile::getInstance($model, $instance);
            $time=time();
            $img_name = $time.$uploaded_image->baseName . '.' . $uploaded_image->extension;
            $uploaded_image->saveAs('user_img/' . $img_name);
            $model->path = 'user_img/user'.$img_name;

            $image = Image::getImagine();
            $newImage = $image->open(Yii::getAlias('@webroot/user_img/'.$img_name));
            $width = $newImage->getSize()->getWidth();
            $height = $newImage->getSize()->getHeight();
            $new_height = ($height*1000)/$width;

            if($height>600){
                $response['valid'] = 'Image height must be less than 600px.';
                unlink(Yii::getAlias('@webroot').'/user_img/'.$img_name);
                return json_encode($response);
            }else{
                $response['valid'] = 'yes';
            }

            if($model->save()){
                if(isset($_POST['from'])){
                    \Yii::$app->session->set('f_user.profile_pic',$model->path);
                }

                if($prev_img!=''){
                    if(file_exists(Yii::getAlias('@webroot').'/'.$prev_img)){
                        unlink(Yii::getAlias('@webroot').'/'.$prev_img);
                    }
                    
                }

                if($img_type == 'cover'){
                    

                    Image::thumbnail('@webroot/user_img/'.$img_name, 900, $new_height)
                        ->save(Yii::getAlias('@webroot').'/user_img/'.$img_name, ['quality' => 100]);

                    }else{
                        Image::thumbnail('@webroot/user_img/'.$img_name, 600, 600)
                        ->save(Yii::getAlias('@webroot').'/user_img/'.$img_name, ['quality' => 100]);
                    }


                $response['files'] = [
                    'name' => $img_name,
                    'type' => $uploaded_image->type,
                    'size' => $uploaded_image->size,
                    'url' => Url::base().'/user_img/'.$img_name,
                    
                ];
                $response['base'] = 'user_img/'.$time.$uploaded_image->baseName;


                return json_encode($response);
            }else{
                $response['base'] = $model->getErrors();

                return json_encode($response);
            }

        }
    }



    public function actionCrop_img(){
        if( Yii::$app->request->isAjax ){
            $height = $_POST['height'];
            $width = $_POST['width'];
            $x = $_POST['x'];
            $y = $_POST['y'];
            $name = $_POST['url'];

            $response = [];


            Image::crop('@webroot/user_img/'.$name, $width, $height,[$x,$y])
                    ->save(Yii::getAlias('@webroot').'/user_img/user'.$name, ['quality' => 100]);

            unlink(Yii::getAlias('@webroot').'/user_img/'.$name);

            $response['url'] = Url::base('').'/user_img/user'.$name;

            return json_encode($response);
        }
    }


    public function actionPayment_method($type){
        if(($type=='') || (isset(\Yii::$app->user->identity) && (\Yii::$app->user->identity->reg_status==1))){
            throw new NotFoundHttpException('The requested page does not exist.');
        }


        $model = new UserAcc();

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

        if($model->load(Yii::$app->request->post())){
            $model->user_id = \Yii::$app->user->identity->id;
            $valid = $model->validate();

            if($valid){
                $model->save();
                $this->redirect(['/user/add_property','type'=>$type]);
            }

        }


        return $this->render('payment_method',[
                                'type'=>$type,
                                'cover_photo'=>$cover_photo,
                                'profile_photo'=>$profile_photo,
                                'model' => $model
                            ]);
    }




    public function actionAdd_property($type){
        if(($type=='') || (isset(\Yii::$app->user->identity) && (\Yii::$app->user->identity->reg_status==1))){
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        
        $model = new LandInfo();

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

        if($model->load(Yii::$app->request->post())){
            $model->user_id = \Yii::$app->user->identity->id;
            $model->status = 1;

            $valid = $model->validate();

            if($valid){
                $model->save();
                $this->redirect(['/user/complete','type'=>$type]);
            }

        }

        return $this->render('add_property',[
                                'type'=>$type,
                                'cover_photo'=>$cover_photo,
                                'profile_photo'=>$profile_photo,
                                'model' => $model
                            ]);
    }




    public function actionComplete($type){
        $user = User::find()->where(['id'=>\Yii::$app->user->identity->id])->one();
        if(!empty($user)){
            $user->reg_status = 1;
            $user->save();
        }

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
        \Yii::$app->session->set('f_user.logged_type',$type);

        return $this->render('complete',[
                                'type'=>$type,
                                'cover_photo'=>$cover_photo,
                                'profile_photo'=>$profile_photo
                            ]);
    }


























    public function actionForgot_pass(){
        $model = new Resetpassword();
        $model->scenario = 'send_token';


        if($model->load(Yii::$app->request->post())){
            $valid = $model->validate();

            if($valid){
                $data = User::find()->where(['email'=>$model->email])->one();
                $data->auth_key = Yii::$app->security->generateRandomString() . '_' . time();
                $data->save();

                $text = 'Please follow the link to complete your password reset process. ';
                $text .= '<a href="'.Yii::$app->urlManager->createAbsoluteUrl(['/user/reset_password','token'=>$data->auth_key]).'">Click Here</a>';

                try{
                    $message = Yii::$app->mailer->compose();

                    $message->setFrom(\Yii::$app->params['admin_email']);
                    $message->setTo($model->email);
                    $message->setSubject("Password Reset");
                    $message->setHtmlBody($text);

                    if($message->send()){
                        \Yii::$app->getSession()->setFlash('success', 'An email has been sent to your email address. Please follow the steps.');
                    }
                }catch(Exception $e){
                    var_dump($e);
                }
            }
        }

        return $this->render('send_reset_token', [
                'model' => $model,
            ]);
    }


    public function actionReset_password($token){
        $model = new Resetpassword();
        $model->scenario = 'reset_pass';

        $data = User::find()->where(['auth_key'=>$token])->one();
        if(empty($data)){
            return $this->goHome();
        }


        if($model->load(Yii::$app->request->post())){
            $valid = $model->validate();

            if($valid){
                $data->password = Yii::$app->security->generatePasswordHash($model->password);
                $data->auth_key = '';

                if($data->save()){
                    return $this->goHome();
                }

            }
        }

        return $this->render('reset_pass', [
                'model' => $model,
            ]);
    }




    public function actionChange_password(){
        $model = User::find()->where(['id'=>\Yii::$app->user->identity->id])->one();
        $model->scenario = 'change_password';


        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post())){
            $model->password = Yii::$app->security->generatePasswordHash($model->new_password);

            if($model->save()){
                \Yii::$app->getSession()->setFlash('success', 'Password Successfully changed.');
                $model = new User();
                $model->scenario = 'change_password';
            }
        }


        return $this->render('change_pass', [
                'model' => $model,
            ]);
    }





    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
