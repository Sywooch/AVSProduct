<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Platforms */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Platforms',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Platforms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="platforms-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
