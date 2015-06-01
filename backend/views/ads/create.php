<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ads */
/* @var $adstype app\models\Adstype[] */
/* @var $categories app\models\Adscategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Ads',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Ads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ads-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'adstype'=> $adstype,
        'categories'=>$categories,
    ]) ?>

</div>
