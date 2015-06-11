<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use miloschuman\highcharts\Highstock;
use miloschuman\highcharts\SeriesDataHelper;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Ads */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Ads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ads-view">

    <p>
        <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'banner_path',
            'banner_base_url:url',
            'name',
            'status',
            'type_id',
            'category_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <?php

        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => '']);
        echo Highstock::widget([
            'options' => [
                'title' => ['text' => Yii::t('app','Statistics for this Ads')],
                'yAxis' => [
                    ['title' => ['text' => Yii::t('app','Actions and Views')]],
                ],
                'series' => [
                    [
                        'type' => 'column',
                        'name' => 'Views',
                        'data' => new SeriesDataHelper($dataProvider, ['date:datetime', 'Views']),
                    ],
                    [
                        'type' => 'column',
                        'name' => 'Actions',
                        'data' => new SeriesDataHelper($dataProvider, ['date:datetime', 'Actions']),
                    ],
                ]
            ]
        ]);
    ?>

</div>
