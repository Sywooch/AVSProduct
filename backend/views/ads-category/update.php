<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Adscategory */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Adscategory',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Adscategories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="adscategory-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
