<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\searchPlatforms */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Platforms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="platforms-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Platforms',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'url:url',
            [
                'attribute'=> 'status',
                'filter'=> true,
                'label' => Yii::t( 'backend', 'Status' ),
                'value' => function ($model) {
                    return $model->getStatusName();
                },
                'contentOptions' => function ( $data ) {
                    $statuses = [
                        0 => 'text-danger',
                        1 => 'text-warning',
                        2 => 'text-success',
                    ];
                    return [ 'class' => $statuses[$data['status']] ];
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
