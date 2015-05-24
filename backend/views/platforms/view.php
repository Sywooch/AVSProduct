<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Platforms */
/* @var $user common\models\User*/

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Platforms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="platforms-view">

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
            'name',
            'url:url',
            [
                'label' => Yii::t( 'backend', 'Status' ),
                'value' => $model->getStatusName(),
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>


    <?php
    if(Yii::$app->user->can('administrator'))
    {
        echo DetailView::widget([
            'model'=> $model->getUser()->One(),
            'attributes'=>[
                'id',
                'username',
                'email',
            ]
        ]);
    }
    ?>

</div>
