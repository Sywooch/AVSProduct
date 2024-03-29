<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Adstype */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Adstype',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Adstypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="adstype-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
