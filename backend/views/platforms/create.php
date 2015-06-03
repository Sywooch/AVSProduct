<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Platforms */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Platforms',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Platforms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="platforms-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
