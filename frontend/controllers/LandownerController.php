<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Html;


use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\Url;

use frontend\models\User;
use frontend\models\LandInfo;
use frontend\models\LandImg;
use frontend\models\LandShedule;


class LandownerController extends Controller
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
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['dashboard','profile','property','viewproperty',
                                      'add_property_image','add_property_schedule','upload_land_photo',
                                      'delete_image','add_schedule','remove_schedule','update_schedule_form',
                                      'update_schedule','inbox', 'compose', 'sent', 'trash'],
                        'allow' => true,
                        'matchCallback' => function() {
                                return isset(\Yii::$app->user->identity) && \Yii::$app->user->identity->login_type=='landowner';                    
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


        return $this->render('profile',['model'=>$model, 
                                        'state'=> $state
                                    ]);
    }



    public function actionProperty(){
        $model = new LandInfo();

        $property_list = LandInfo::find()->where(['user_id'=>\Yii::$app->user->identity->id])->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->status = 1;
            $model->user_id = \Yii::$app->user->identity->id;

            $valid = $model->validate();

            if($valid){
                if($model->save()){

                    $this->redirect(['/landowner/property']);
                }
            }else{
                echo '<pre>';
                var_dump($model->getErrors());
                exit();
            }
        }

        return $this->render('your_property',[
                                        'model'=>$model,
                                        'property_list'=>$property_list
                                    ]);
    }




    public function actionViewproperty($id,$title){
        $model = LandInfo::find()->where(['id'=>$id])->one();

        return $this->render('view_property',[
                                        'model'=>$model,
                                    ]);
    }

    public function actionAdd_property_image($id,$title){
        $model = LandInfo::find()->where(['id'=>$id])->one();
        
        $img_all = LandImg::find()->where(['land_id'=>$id])->all();
        $img_model = new LandImg();

        return $this->render('add_property_image',[
                                        'model'=>$model,
                                        'img_model'=>$img_model,
                                        'img_all'=>$img_all
                                    ]);
    }


    public function actionUpload_land_photo(){
        if( Yii::$app->request->isAjax ){
            $model = new LandImg();

            $model_img = UploadedFile::getInstance($model, 'path');
            $time=time();
            $img_name = $time.$model_img->baseName . '.' . $model_img->extension;

            $model_img->saveAs('land_img/' . $img_name);


            if($model_img){
                $response = [];

                $model->title = $_POST['title'];
                $model->desc = $_POST['desc'];
                $model->type = 'land';
                $model->land_id = $_POST['land_id'];
                $model->path = 'land_img/'.$img_name;
                $model->user_id = \Yii::$app->user->identity->id;

                if($model->save()){

                    $response['files'][] = [
                        'name' => $time.$model_img->name,
                        'type' => $model_img->type,
                        'size' => $model_img->size,
                        'url' => Url::base().'/land_img/' . $img_name,
                        'deleteUrl' => Url::to(['delete_uploaded_file', 'file' => $img_name]),
                        'deleteType' => 'DELETE'
                    ];

                    $response['base'] = $time.$model_img->baseName;
                    $response['view'] = $this->renderAjax('_uploaded_image', [
                            'url' => Url::base().'/land_img/' . $img_name,
                            'basename' => $time.$model_img->baseName,
                            'id' => $model->id,
                            'model' =>$model
                        ]);

                }else{

                    $response['errors'] = $model->getErrors();
                }

                return json_encode($response);
            }

        }
    }


    public function actionDelete_image(){
        if( Yii::$app->request->isAjax ){
            $response = [];

            $image_id = $_POST['id'];
            $img = LandImg::find()->where(['id'=>$image_id,'user_id'=>\Yii::$app->user->identity->id])->one();


            if(!empty($img)){
                $path = $img->path;

                if($img->delete()){
                    unlink(Yii::getAlias('@webroot').'/'.$path);
                    $response['result'] = 'Success';
                }else{
                    $response['result'] = 'Error';
                }
            }else{
                $response['result'] = 'Error';
            }

            return json_encode($response);
        }
    }

    public function actionAdd_property_schedule($id,$title){
        $model = LandInfo::find()->where(['id'=>$id])->one();
        $LandShedule = new LandShedule();


        /*$user = Yii::$app->db->createCommand('SELECT * from `land_shedule` where 
                    (time(`start_time`) > time("02:00:00") and time(`start_time`) < time("04:00:00")) || 
                    (time(`end_time`) > time("02:00:00") and time(`end_time`) < time("04:00:00")) || 
                    (time(`start_time`) = time("02:00:00") and time(`end_time`) = time("04:00:00"))' )
                ->queryAll();

        echo '<pre>';
        var_dump($user);
        exit();*/

        $all_schedule = LandShedule::find()->where(['land_id'=>$id])->orderBy('start_time asc')->all();

        return $this->render('add_property_schedule',[
                                        'model'=>$model,
                                        'LandShedule' => $LandShedule,
                                        'all_schedule' => $all_schedule
                                    ]);
    }


    public function actionAdd_schedule(){
        if( Yii::$app->request->isAjax ){
            $response = [];

            $model = new LandShedule();
            $model->scenario = 'insert';
            if ($model->load(Yii::$app->request->post())) {

                $model->status = 1;
                $model->user_id = \Yii::$app->user->identity->id;
                $model->start_time = $model->start_time.':00:00';
                $model->end_time = $model->end_time.':00:00';

                $target = $model->target;

                $valid = $model->validate();
                if($valid){

                    
                    $model->save();

                    $response['result'] = 'success';
                    $response['sd'] = $target;
                    $response['view'] = $this->renderAjax('_schedule_item',['model'=>$model,'target'=>$target]);
                }else{
                    $response['result'] = 'error';
                    $response['errors'] = Html::errorSummary($model);
                }

            }

            return json_encode($response);
        }
    }



    public function actionRemove_schedule(){
        if( Yii::$app->request->isAjax ){
            $response = [];

            $id = $_POST['id'];
            $model = LandShedule::find()->where(['id'=>$id,'user_id'=>\Yii::$app->user->identity->id])->one();
            if (!empty($model)) {

                if($model->delete()){

                    $response['result'] = 'success';
                }else{
                    $response['result'] = 'error';
                    $response['errors'] = Html::errorSummary($model);
                }

            }else{
                $response['result'] = 'error';
                $response['errors'] = Html::errorSummary($model);
            }

            return json_encode($response);
        }
    }



    public function actionUpdate_schedule_form(){
        if( Yii::$app->request->isAjax ){
            $response = [];

            $id = $_POST['id'];
            $target = $_POST['target'];


            $LandShedule = LandShedule::find()->where(['id'=>$id,'user_id'=>\Yii::$app->user->identity->id])->one();
            if (!empty($LandShedule)) {
                $LandShedule->start_time = explode(':', $LandShedule->start_time)[0];
                $LandShedule->end_time = explode(':', $LandShedule->end_time)[0];

                $response['result'] = 'success';
                $response['view'] = $this->renderAjax('_update_schedule_form',['LandShedule'=>$LandShedule,'target'=>$target]);
            }else{
                $response['result'] = 'error';
                $response['errors'] = Html::errorSummary($LandShedule);
            }

            return json_encode($response);
        }
    }


    public function actionUpdate_schedule(){
        if( Yii::$app->request->isAjax ){
            $response = [];

            $model = new LandShedule();
            $model->scenario = 'update';
            if ($model->load(Yii::$app->request->post())) {

                $model->status = 1;
                $model->user_id = \Yii::$app->user->identity->id;
                $model->start_time = $model->start_time.':00:00';
                $model->end_time = $model->end_time.':00:00';

                $valid = $model->validate();
                if($valid){

                    $LandShedule = LandShedule::find()->where(['id'=>$model->id,'user_id'=>\Yii::$app->user->identity->id])->one();
                    if (!empty($LandShedule)) {

                        $LandShedule->start_time = $model->start_time;
                        $LandShedule->end_time = $model->end_time;
                        $LandShedule->price = $model->price;

                        $LandShedule->save();

                        $response['result'] = 'success';
                        $response['time'] = date('h:i A', strtotime($LandShedule->start_time)).' - '.date('h:i A', strtotime($LandShedule->end_time));
                        $response['price'] = '$'.$LandShedule->price;
                        $response['schedule_id'] = $LandShedule->id;
                     
                     }else{
                        $response['result'] = 'error';
                        $response['errors'] = var_dump($model);
                    }
                }else{
                    $response['result'] = 'error';
                    $response['errors'] = Html::errorSummary($model);
                }
            }

            return json_encode($response);
        }
    }



    


}
