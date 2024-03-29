<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ads */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Ads',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Ads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="ads-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'adstype'=>$adstype,
        'categories'=>$categories,
    ]) ?>

</div>
