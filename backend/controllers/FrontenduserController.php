<?php

namespace backend\controllers;

use Yii;
use backend\models\UserF;
use backend\models\UserFSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FrontenduserController implements the CRUD actions for UserF model.
 */
class FrontenduserController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $searchModel = new UserFSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,1);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUnapproved()
    {
        $searchModel = new UserFSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,0);

        return $this->render('unapproved', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionUnapprove($id)
    {
        $model = UserF::find()->where(['id'=>$id])->one();

        if(!empty($model)){
            $model->status = 0;
            if($model->save()){
                return $this->redirect(['frontenduser/index']);
            }else{
                var_dump($model->getErrors());
            }

            
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }


    public function actionApprove($id)
    {
        $model = UserF::find()->where(['id'=>$id])->one();

        if(!empty($model)){
            $model->status = 1;
            if($model->save()){
                return $this->redirect(['frontenduser/unapproved']);
            }else{
                var_dump($model->getErrors());
            }

            
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }




    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new UserF();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }



    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }




    protected function findModel($id)
    {
        if (($model = UserF::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
