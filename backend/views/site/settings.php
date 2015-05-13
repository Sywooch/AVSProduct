<?php
/**
 * @author Andrey Avseenko <bropwnz0r@gmail.com>
 */
$this->title = Yii::t('frontend', 'Application settings');
echo \common\components\keyStorage\FormWidget::widget([
    'model' => $model,
    'formClass' => '\yii\bootstrap\ActiveForm',
    'submitText' => Yii::t('backend', 'Save'),
    'submitOptions' => ['class' => 'btn btn-primary']
]);
