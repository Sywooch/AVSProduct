<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BlockCode */
/* @var $platforms backend\models\Platforms[] */
/* @var $categories backend\models\Adscategory[] */
/* @var $adstype backend\models\Adstype[] */

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
