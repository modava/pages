<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\widgets\ToastrWidget;
use modava\pages\PagesModule;

/* @var $this yii\web\View */
/* @var $model modava\pages\models\pagesPartner */
/* @var $form yii\widgets\ActiveForm */
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-form']) ?>
<div class="pages-partner-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'language')
                ->dropDownList(Yii::$app->params['availableLocales'])
                ->label(PagesModule::t('pages', 'Ngôn ngữ')) ?>

        </div>
    </div>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?php
    if (empty($model->getErrors()))
        $path = Yii::$app->params['partner']['150x150']['folder'];
    else
        $path = null;
    echo \modava\tiny\FileManager::widget([
        'model' => $model,
        'attribute' => 'image',
        'path' => $path,
        'label' => PagesModule::t('pages', 'Hình ảnh') . ': ' . Yii::$app->params['partner-size'],
    ]); ?>

    <?php if (Yii::$app->controller->action->id == 'create') $model->status = 1; ?>
    <?= $form->field($model, 'status')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton(PagesModule::t('pages', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
