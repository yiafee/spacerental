<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Message;
use frontend\models\MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
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


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['inbox', 'compose', 'sent', 'trash', 'trash_item','restore_item',
                        'remove_item'],
                        'allow' => true,
                        'matchCallback' => function() {
                                return isset(\Yii::$app->user->identity);                    
                                },
                    ],
                ],
            ],
            
        ];
    }

    

    public function actionCompose(){
        $model = new Message();

        if ($model->load(Yii::$app->request->post())) {
            $model->type = 'sent';
            $model->from = \Yii::$app->user->identity->id;
            $model->trash = 0;

            $valid = $model->validate();
            if($valid){
                $model->save();
                \Yii::$app->getSession()->setFlash('success', 'Message successfully sent.');
            }

        }

        return $this->render('compose',['model'=>$model]);
    }


    public function actionInbox(){
        $data = Message::find()->where(['to'=>\Yii::$app->user->identity->id,'trash'=>0])->all();

        return $this->render('inbox',['data'=>$data]);
    }


    public function actionSent(){
        $data = Message::find()->where(['from'=>\Yii::$app->user->identity->id,'trash'=>0])->all();
        return $this->render('sent',['data'=>$data]);
    }


    public function actionTrash(){
        $data = Message::find()->where(['from'=>\Yii::$app->user->identity->id,'trash'=>1])
                               ->orWhere(['to'=>\Yii::$app->user->identity->id,'trash'=>1])
                               ->all();

        return $this->render('trash',['data'=>$data]);
    }



    public function actionTrash_item(){
        if( Yii::$app->request->isAjax ){
            $response = [];

             if (isset($_POST['data'])) {
                try{

                    foreach ($_POST['data'] as $value) {

                        $model = $this->findModel($value);
                        $model->trash = 1;

                        $model->save();
                    }

                    $response['result'] = ['success'];
                    $response['msg'] = ['ok'];

                }catch(Exception $e){
                    $response['msg'] = $e;
                }
             }

            return json_encode($response);
        }
    }


    public function actionRestore_item(){
        if( Yii::$app->request->isAjax ){
            $response = [];

             if (isset($_POST['data'])) {
                try{

                    foreach ($_POST['data'] as $value) {

                        $model = $this->findModel($value);
                        $model->trash = 0;

                        $model->save();
                    }

                    $response['result'] = ['success'];
                    $response['msg'] = ['ok'];

                }catch(Exception $e){
                    $response['msg'] = $e;
                }
             }

            return json_encode($response);
        }
    }

    public function actionRemove_item(){
        if( Yii::$app->request->isAjax ){
            $response = [];

             if (isset($_POST['data'])) {
                try{

                    foreach ($_POST['data'] as $value) {

                        $model = $this->findModel($value);
                        $model->delete();
                    }

                    $response['result'] = ['success'];
                    $response['msg'] = ['ok'];

                }catch(Exception $e){
                    $response['msg'] = $e;
                }
             }

            return json_encode($response);
        }
    }






    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
