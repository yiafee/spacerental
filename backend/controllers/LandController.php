<?php

namespace backend\controllers;

use Yii;
use backend\models\Land;
use backend\models\LandSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use kartik\mpdf\Pdf;

/**
 * LandController implements the CRUD actions for Land model.
 */
class LandController extends Controller
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

    public function actionPdf($id){
        $this->layout = 'blank_layout';

        $model = $this->findModel($id);
        $content = $this->renderPartial('_pdf', [
            'model' => $model,
        ]);

            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_UTF8, 
                // A4 paper format
                'format' => Pdf::FORMAT_A4, 
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT, 
                'filename' => time().'test.pdf',
                // stream to browser inline
                'destination' => Pdf::DEST_BROWSER, 
                // your html content input
                'content' => $content,  
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting 
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}', 
                 // set mPDF properties on the fly
                'options' => ['title' => 'Food Truck Space'],
                 // call mPDF methods on the fly
                'methods' => [ 
                    'SetHeader'=>[date("Y-m-d H:i:s")], 
                    'SetFooter' =>  [
                                        '<div class="invoice_footer">
                                            <div class="footer_left">
                                                <p style="font-size:11px; text-align:left;">Customer Signature</p>
                                            </div>
                                            <div class="footer_right">
                                                <p style="font-size:11px;">Authorised Sinature</p>
                                            </div>
                                        </div>'
                                    ],
                ]
            ]);

        return $pdf->render();
            
    }

    

    public function actionIndex()
    {
        $searchModel = new LandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'1');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionUnapprove($id)
    {
        $model = Land::find()->where(['id'=>$id])->one();

        if(!empty($model)){
            $model->status = 0;
            if($model->save()){
                return $this->redirect(['land/index']);
            }else{
                var_dump($model->getErrors());
            }

            
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }

    public function actionApprove($id)
    {
        $model = Land::find()->where(['id'=>$id])->one();

        if(!empty($model)){
            $model->status = 1;
            if($model->save()){
                return $this->redirect(['land/unapproved']);
            }else{
                var_dump($model->getErrors());
            }

            
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }


    public function actionUnapproved()
    {
        $searchModel = new LandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'0');

        return $this->render('unapproved', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
        if (($model = Land::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
