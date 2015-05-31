<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use yii\filters\VerbFilter;
use backend\models\Resetpassword;

use backend\models\ActivityLog;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function beforeAction($action){
        if(Yii::$app->params['setup.status']!="Installed"){
            return $this->redirect(['/setup/index']);
        }
        
        $this->getView()->theme = Yii::createObject([
            'class' => '\yii\base\Theme',
            'pathMap' => ['@app/views' => '@app/web/themes/'.Yii::$app->params['backend.theme']],
            'baseUrl' => '@web/themes/'.Yii::$app->params['backend.theme'],
        ]);

        return parent::beforeAction($action);
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    public function actionAccesscontrol(){
        return $this->render('accesscontrol');
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        
        return $this->render('index');
    }


    public function actionLogin($previous="")
    {
        $this->layout='login_layout';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $timestamp = date("Y-m-d h:i:s");
            \Yii::$app->session->set('user.email',$model->email);
            \Yii::$app->session->set('user.last_access',$timestamp);
            \Yii::$app->session->set('user.image',$model->User->image);
            \Yii::$app->session->set('user.id',$model->User->id);

            $user = User::find()->where(['id' => $model->User->id])->one();
            $user->last_access = $timestamp;
            $user->save();

            if(!empty($previous)){
                return $this->redirect($previous);
            }
            else{
                return $this->goBack();
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionForgot_password(){
        $this->layout='login_layout';

        $model = new Resetpassword();
        $model->scenario = 'send_token';


        if($model->load(Yii::$app->request->post())){
            $valid = $model->validate();

            if($valid){
                $data = User::find()->where(['email'=>$model->email])->one();
                $data->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
                $data->save();

                $text = 'Please follow the link to complete your password reset process. ';
                $text .= '<a href="'.Yii::$app->urlManager->createAbsoluteUrl(['/site/reset_password','token'=>$data->password_reset_token]).'">Click Here</a>';

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
        $this->layout='login_layout';

        $model = new Resetpassword();
        $model->scenario = 'reset_pass';

        $data = User::find()->where(['password_reset_token'=>$token])->one();
        if(empty($data)){
            return $this->goHome();
        }


        if($model->load(Yii::$app->request->post())){
            $valid = $model->validate();

            if($valid){
                $data->password = Yii::$app->security->generatePasswordHash($model->password);
                $data->password_reset_token = '';

                if($data->save()){
                    $this->redirect(['site/login']);
                }

            }
        }

        return $this->render('reset_pass', [
                'model' => $model,
            ]);
    }



}
