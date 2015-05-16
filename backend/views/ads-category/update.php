<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdsCategory */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Ads Category',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Ads Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="ads-category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
