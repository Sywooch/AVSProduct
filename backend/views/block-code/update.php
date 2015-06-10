<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BlockCode */
/* @var $platforms app\models\Platforms[] */
/* @var $categories app\models\Adscategory[] */
/* @var $adstype app\models\Adstype[] */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Block Code',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Block Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="block-code-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'platforms' => $platforms,
        'categories' => $categories,
        'adstype'=>$adstype,
    ]) ?>

</div>
