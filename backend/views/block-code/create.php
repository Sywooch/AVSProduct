<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BlockCode */
/* @var $platforms app\models\Platforms[] */
/* @var $categories app\models\Adscategory[] */
/* @var $adstype app\models\Adstype[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Block Code',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Block Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-code-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'platforms' => $platforms,
        'categories' => $categories,
        'adstype'=>$adstype,
    ]) ?>

</div>
