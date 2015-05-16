<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AdsCategory */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Ads Category',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Ads Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ads-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
