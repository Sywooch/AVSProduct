<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Platforms */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="platforms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php if(Yii::$app->user->can('administrator')) {
          echo $form->field($model, 'status')->dropDownList(
              $model->getStatusesArray(),
              ['options' =>
                  [
                      $model->status => ['selected ' => true]
                  ]
              ]);
    }?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
