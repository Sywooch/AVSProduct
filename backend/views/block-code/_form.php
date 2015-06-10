<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JqueryAsset;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\BlockCode */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $platforms backend\models\Platforms[] */
/* @var $categories backend\models\Adscategory[] */

$this->registerJsFile("@web/plugin/bs/bs-wizard.js", ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile("@web/plugin/bs/bs-wizard-min.css");
?>

<div class="row bs-wizard">
    <div class="col-lg-3">
        <ol class="bs-wizard-sidebar">
            <li class="bs-wizard-todo bs-wizard-active"><a href="javascript:void(0)"><?php echo Yii::t('app','Your Platform') ?></a></li>
            <li class="bs-wizard-todo"><a href="javascript:void(0)"><?php echo Yii::t('app','Categories Platform') ?></a></li>
            <li class="bs-wizard-todo"><a href="javascript:void(0)"><?php echo Yii::t('app','Generate code block') ?></a></li>
        </ol>
    </div>
    <div class="col-lg-9">
        <?php $form = ActiveForm::begin(); ?>
        <?php echo $form->errorSummary($model); ?>
            <fieldset>
                <div class="bs-step inv">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo Yii::t('app', 'Please fill in your platform') ?></h3>
                        </div>
                        <div class="panel-body bs-step-inner">
                            <div class="form-group">
                                <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->field($model, 'platform_id')->dropDownList(\yii\helpers\ArrayHelper::map(
                                    $platforms,
                                    'id',
                                    'name'
                                ), ['prompt'=>Yii::t('app','Select type')]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->field($model, 'adstype_id')->dropDownList(\yii\helpers\ArrayHelper::map(
                                    $adstype,
                                    'id',
                                    'name'
                                ), ['prompt'=>Yii::t('app','Select type')]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bs-step inv">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo Yii::t('app','Please provide categories') ?></h3>
                        </div>
                        <div class="panel-body bs-step-inner">

                            <div class="clearfix"></div>
                            <div class="form-group">
                                <?php echo $form->field($model, 'categories')->checkboxList(ArrayHelper::map($categories, 'id', 'name')) ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bs-step inv">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo Yii::t('app','Generate code block') ?></h3>
                        </div>
                        <div class="panel-body bs-step-inner">


                            <div class="clearfix"></div>
                            <button id="last-back" type="reset" class="btn btn-default">Go Back</button>
                                <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </fieldset>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<!---->
<!--<div class="block-code-form">-->

<!--    --><?php //$form = ActiveForm::begin(); ?>
<!---->
<!--    --><?php //echo $form->errorSummary($model); ?>
<!---->
<!--    --><?php //echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!--    --><?php //echo $form->field($model, 'platform_id')->dropDownList(\yii\helpers\ArrayHelper::map(
//        $platforms,
//        'id',
//        'name'
//    ), ['prompt'=>Yii::t('app','Select type')]); ?>

<!--    <div class="form-group">-->
<!--    </div>-->

<!--    --><?php //ActiveForm::end(); ?>

<!--</div>-->

<?php
//todo error block view step 1;
$init = <<< INIT
    var form = $(".bs-wizard");

    step = 1;

    form.bs_wizard({
            beforeNext: before_next
    });

    function before_next(){
        var name = $('#blockcode-name').val();
        var platformID = $('#blockcode-platform_id').val();
        var typePlatform = $('#blockcode-adstype').val();
        var categories = $("input[name='BlockCode[categories][]']").val();

        if(name.length>0 || platformID.length>0 || typePlatform.length>0)
        {
            form.bs_wizard('show_step', 2);
        }
        if($('input[type=checkbox]:checked').length>0){
            form.bs_wizard('show_step', 3);
        }

        console.log('error');
    }
    $('#last-back').click(form.bs_wizard('go_prev'));
    $(document).on('click','.next',function(){
        $("html, body").animate({ scrollTop: 0 }, "slow");
    })
INIT;

$this->registerJs($init);

$stepNav = <<< NAV
$(document).on('click','.set-step',function(){
    var showStep = $(this).attr('data-step');
    $(".bs-wizard").bs_wizard('show_step', showStep);
});
NAV;
$this->registerJs($stepNav);
?>