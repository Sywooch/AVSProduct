<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Adscategory */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Adscategory',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Adscategories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adscategory-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
