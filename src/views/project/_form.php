<?php

use yii\helpers\Html;
use unclead\multipleinput\MultipleInput;
use yii\widgets\ActiveForm;
use backend\widgets\ToastrWidget;
use modava\pages\PagesModule;

/* @var $this yii\web\View */
/* @var $model modava\pages\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-form']) ?>
<div class="project-form">
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

    <?= $form->field($model, 'description')->widget(\modava\tiny\TinyMce::class, [
        'options' => ['rows' => 6],
    ]) ?>

    <?= $form->field($model, 'content')->widget(\modava\tiny\TinyMce::class, [
        'options' => ['rows' => 15],
        'type' => 'content',
    ]) ?>

    <div class="row">
        <div class="col-8">
            <?= $form->field($model, 'tech')->widget(MultipleInput::class, [
                'max' => 6,
                'allowEmptyList' => true,
                'columns' => [
                    [
                        'name' => 'tech',
                        'type' => 'dropDownList',
                        'title' => PagesModule::t('pages', 'Thuộc tính dự án'),
                        'defaultValue' => 1,
                        'items' => Yii::$app->params['tech'],
                    ],
                    [
                        'name' => 'value',
                        'title' => PagesModule::t('pages', 'Giá trị'),
                        'enableError' => true,
                        'options' => [
                            'class' => 'input-priority'
                        ]
                    ]
                ]
            ])->label(false);
            ?>
        </div>
        <div class="col-4">
            <?php
            if (empty($model->getErrors()))
                $path = Yii::$app->params['project']['150x150']['folder'];
            else
                $path = null;
            echo \modava\tiny\FileManager::widget([
                'model' => $model,
                'attribute' => 'image',
                'path' => $path,
                'label' => PagesModule::t('pages', 'Hình ảnh') . ': ' . Yii::$app->params['project-size'],
            ]); ?>
        </div>
    </div>
    <?php if (Yii::$app->controller->action->id == 'create') $model->status = 1; ?>
    <?= $form->field($model, 'status')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton(PagesModule::t('pages', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
