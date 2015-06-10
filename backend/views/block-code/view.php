<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BlockCode */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Block Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-code-view">

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
            'platform_id',
            'hash_block',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <textarea class="form-control" rows="6">
                <div id="AvsBlock" data-hash="<?php echo $model->hash_block ?>"></div>
                <script src="<?php echo Yii::$app->urlManagerFrontend->hostInfo .'/plugins/AvsLoad.js';?>"></script>
            </textarea>
        </div>
    </div>

</div>
