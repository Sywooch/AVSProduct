<?php
namespace frontend\modules\api\v1\controllers;

use backend\models\AdsEvents;
use backend\models\AdsViews;
use backend\models\Platforms;
use Yii;
use frontend\modules\api\v1\resources\Banner;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;

/**
 * Class ArticleController
 * @author Andrey Avseenko <bropwnz0r@gmail.com>
 */
class BannerController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'frontend\modules\api\v1\resources\Banner';
    /**
     * @var array
     */
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider']
            ],
            'view' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction'
            ],
        ];
    }

    /**
     * @return json data
     */
    public function actionAds()
    {
        $banner = new Banner();
        die(json_encode($banner->getImgUrl(Yii::$app->request->get('hash_block'), Yii::$app->request->get('host'))));
    }

    /**
     * action View banner
     */
    public function actionViewAds()
    {
        $view = new AdsViews();
        $platform = Platforms::find()->where(['like', 'url', Yii::$app->request->post('domain')])->one();
        $view->setView(Yii::$app->request->post('ads_id'),$platform->id, Yii::$app->request->post('unique'));
    }

    public function actionEvent()
    {
        $event = new AdsEvents();
        $platform = Platforms::find()->where(['like', 'url', Yii::$app->request->post('domain')])->one();
        if($event->checkUniqueEvent(Yii::$app->request->post('ipAddress'), Yii::$app->request->post('ads_id'), $platform->id))
        {
            $event->setEvent(Yii::$app->request->post('ipAddress'), Yii::$app->request->post('ads_id'), $platform->id, 1);
        }
    }
    /**
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        return new ActiveDataProvider(array(
            'query' => Banner::find(),
        ));
    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws HttpException
     */
    public function findModel($id)
    {
        $model = Banner::find()
            ->andWhere(['id' => (int)$id])
            ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }

}