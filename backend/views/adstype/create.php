<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Adstype */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Adstype',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Adstypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adstype-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
