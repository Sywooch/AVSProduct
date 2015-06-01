<?php

namespace backend\controllers;

use app\models\Adscategory;
use app\models\Adstype;
use app\models\CodeblocksAdscategories;
use app\models\Platforms;
use Yii;
use app\models\BlockCode;
use app\models\search\BlockCodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlockCodeController implements the CRUD actions for BlockCode model.
 */
class BlockCodeController extends Controller
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
     * Lists all BlockCode models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlockCodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlockCode model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BlockCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlockCode();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $categories = $post['BlockCode']['categories'];
            $model->hash_block = md5($post['BlockCode']['name'].$post['BlockCode']['platform_id'].rand('100', '1000'));
            if($model->save())
            {
                foreach($categories as $category)
                {
                    $block_cat = new CodeblocksAdscategories();
                    $block_cat->adscategory_id = $category;
                    $block_cat->blockcode_id = $model->id;
                    $block_cat->save(false);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'platforms'=>Platforms::find()->where(['status'=>2])->all(),
                'categories'=>Adscategory::find()->all(),
                'adstype'=> Adstype::find()->all(),
            ]);
        }
    }

    /**
     * Updates an existing BlockCode model.
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
                'platforms'=>Platforms::find()->where(['status'=>2])->all(),
                'categories'=>Adscategory::find()->all(),
                'adstype'=> Adstype::find()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing BlockCode model.
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
     * Finds the BlockCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlockCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlockCode::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
