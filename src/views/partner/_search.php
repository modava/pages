<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modava\pages\PagesModule;

/* @var $this yii\web\View */
/* @var $model modava\pages\models\search\PartnerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-partner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'link') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(PagesModule::t('pages', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(PagesModule::t('pages', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
