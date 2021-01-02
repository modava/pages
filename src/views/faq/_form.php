<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\ToastrWidget;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model modava\pages\models\PagesFaq */
/* @var $form yii\widgets\ActiveForm */
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-form']) ?>
<div class="pages-faq-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'language')
                ->dropDownList(Yii::$app->params['availableLocales'], ['prompt' => Yii::t('backend', 'Chọn ngôn ngữ...')])
                ->label(Yii::t('backend', 'Ngôn ngữ')) ?>

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'content')->widget(MultipleInput::class, [
                'max' => 6,
                'allowEmptyList' => true,
                'columns' => [
                    [
                        'name' => 'question',
                        'title' => Yii::t('backend', 'Câu hỏi'),
                    ],
                    [
                        'name' => 'answer',
                        'type' => 'textArea',
                        'title' => Yii::t('backend', 'Câu trả lời'),
                        'enableError' => true,
                        'options' => [
                            'class' => 'input-priority'
                        ]
                    ]
                ]
            ])->label(false);
            ?>
        </div>
    </div>

    <?php if (Yii::$app->controller->action->id == 'create') $model->status = 1; ?>
    <?= $form->field($model, 'status')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
