<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Ads */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $adstype app\models\Adstype[] */

?>

<div class="ads-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(
            $adstype,
            'id',
            'name'
        ), ['prompt'=>Yii::t('app','Select type')]); ?>

    <?php echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        $categories,
        'id',
        'name'
    ), ['prompt'=>Yii::t('app','Select category')]); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'action_url')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'picture')->widget(Upload::classname(), [
        'url'=>['banner-upload']
    ]) ?>

    <?php echo $form->field($model, 'status')->dropDownList(
        $model->getStatusesArray(),
        ['options' =>
            [
                $model->status => ['selected ' => true]
            ]
        ]); ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
