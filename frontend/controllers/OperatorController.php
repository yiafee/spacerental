<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Html;


use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\models\User;


class OperatorController extends Controller
{

    public function beforeAction($action){
        
        $this->getView()->theme = Yii::createObject([
            'class' => '\yii\base\Theme',
            'pathMap' => ['@app/views' => '@app/web/themes/'.Yii::$app->params['frontend.theme']],
            'baseUrl' => '@web/themes/'.Yii::$app->params['frontend.theme'],
        ]);

        
        if(isset(\Yii::$app->user->identity) && \Yii::$app->user->identity->reg_status==0){
            $resend = 'yes';
            $url = \Yii::$app->urlManager->createAbsoluteUrl(['user/confirm_email','resend'=>$resend]);
            \Yii::$app->getResponse()->redirect($url);
        }

        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['dashboard','profile'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['dashboard','profile'],
                        'allow' => true,
                        'matchCallback' => function() {
                                return isset(\Yii::$app->user->identity) && \Yii::$app->session->get('f_user.logged_type')=='operator';                    
                                },
                    ],
                ],
            ],
            
        ];
    }

    


    public function actionDashboard(){

        return $this->render('dashboard');
    }




    public function actionProfile(){
        $model = User::find()->where(['id'=>\Yii::$app->user->identity->id])->one();
        $model->scenario = 'personal_info';
        $state = '';


        if(!empty($model->date_of_birth)){
            $date = explode('-', $model->date_of_birth);
            $model->day = $date['2'];
            $model->month = $date['1'];
            $model->year = $date['0'];
        }

        if ($model->load(Yii::$app->request->post())) {
            $state = 'post';
            $valid = $model->validate();

            if($valid){
                $model->date_of_birth = $model->year.'-'.$model->month.'-'.$model->day;
                if($model->save()){
                    $state = '';
                    \Yii::$app->getSession()->setFlash('success', 'Successfully Saved.');
                }
            }
        }

        return $this->render('profile',['model'=>$model, 'state'=> $state]);
    }

}
