<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;

use app\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\widgets\ActiveForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
    
    public function behaviors()
    {
        return [
            /*'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],*/
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpload_pic(){
        if( Yii::$app->request->isAjax ){
            $model = User::find()->where(['id' => $_POST['id']])->one();

            $prev_img = $model->image;

            $uploaded_image = UploadedFile::getInstance($model, 'image');
            $time=time();
            $img_name = $time.$uploaded_image->baseName . '.' . $uploaded_image->extension;

            $uploaded_image->saveAs('user_img/' . $img_name);

            $model->image = 'user'.$img_name;

            if($model->save()){

                if($prev_img!=''){
                    unlink(Yii::getAlias('@webroot').'/user_img/'.$prev_img);
                }

                Image::thumbnail('@webroot/user_img/'.$img_name, 600, 600)
                    ->save(Yii::getAlias('@webroot').'/user_img/'.$img_name, ['quality' => 100]);


                $response = [];

                $response['files'] = [
                    'name' => $time.$uploaded_image->name,
                    'type' => $uploaded_image->type,
                    'size' => $uploaded_image->size,
                    'url' => Url::base().'/user_img/' . $img_name,
                    
                ];
                $response['base'] = $time.$uploaded_image->baseName;

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

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            $valid = $model->validate();

            if($valid){
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
                $model->auth_key = Yii::$app->security->generateRandomString();

                $model_image = UploadedFile::getInstance($model, 'image');
                $time=time();

                $model->image = $time.$model_image->baseName . '.' . $model_image->extension;

                if($model->save()){
                    $model_image->saveAs('user_img/' . $time.$model_image->baseName . '.' . $model_image->extension);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $img = $model->image;

        if ($model->load(Yii::$app->request->post())) {
            $model_image = UploadedFile::getInstance($model, 'image');
            $time=time();

            if(!empty($model_image)){
                $model->image = $time.$model_image->baseName . '.' . $model_image->extension;
            }else{
                $model->image = $img;
            }

            if($model->save()){
                if(!empty($model_image)){
                    $model_image->saveAs('user_img/' . $time.$model_image->baseName . '.' . $model_image->extension);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $image = $model->image;
        if($model->delete()){
            if(!empty($image)){
                unlink(\Yii::getAlias('@webroot').'/user_img/'.$image);
            }
        }
        

        return $this->redirect(['index']);
    }

       

    public function actionChange_password(){
        $model = User::find()->where(['id'=>\Yii::$app->session->get('user.id')])->one();
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
