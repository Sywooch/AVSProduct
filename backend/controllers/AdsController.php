<?php

namespace backend\controllers;

use backend\models\Adstype;
use backend\models\Adscategory;
use Yii;
use backend\models\Ads;
use backend\models\search\AdsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;

/**
 * AdsController implements the CRUD actions for Ads model.
 */
class AdsController extends Controller
{
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

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'banner-upload' => [
                'class' => UploadAction::className(),
                'deleteRoute' => 'banner-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'banner-delete' => [
                'class' => DeleteAction::className()
            ]
        ];
    }
    /**
     * Lists all Ads models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ads model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
//        $data = [
//            ['date' => '2006-05-14T20:00:00-0400', 'Views' => 67.37, 'Actions' => 68.38],
//            ['date' => '2006-05-15T20:00:00-0400', 'Views' => 68.1, 'Actions' => 68.25],
//            ['date' => '2006-05-16T20:00:00-0400', 'Views' => 64.7, 'Actions' => 65.7],
//            ['date' => '2006-05-17T20:00:00-0400', 'Views' => 65.68, 'Actions' => 66.26],
//            ['date' => '2006-05-18T20:00:00-0400', 'Views' => 63.26, 'Actions' => 64.88],
//            ['date' => '2006-05-21T20:00:00-0400', 'Views' => 63.87, 'Actions' => 63.99],
//            ['date' => '2006-05-22T20:00:00-0400', 'Views' => 64.86, 'Actions' => 65.19],
//            ['date' => '2006-05-23T20:00:00-0400', 'Views' => 62.99, 'Actions' => 63.65],
//            ['date' => '2006-05-24T20:00:00-0400', 'Views' => 64.26, 'Actions' => 64.45],
//            ['date' => '2006-05-25T20:00:00-0400', 'Views' => 64.31, 'Actions' => 64.56],
//        ];
        return $this->render('view', [
            'model' => $this->findModel($id),
//            'data' => $data
        ]);
    }
    public function actionStat(){
        $ads = Ads::findOne(1);
        $views = $ads->getView()->orderBy(['created_at'])->all();
        $events = $ads->getEvent()->all();
//        $events = $ads->getEvent()->all();
        print_r($events);
        die();
    }

    /**
     * Creates a new Ads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ads();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'adstype'=> Adstype::find()->all(),
                'categories'=>Adscategory::find()->all(),
            ]);
        }
    }

    /**
     * Updates an existing Ads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'adstype'=> Adstype::find()->all(),
                'categories'=>Adscategory::find()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing Ads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ads::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
