<?php

namespace modava\pages\controllers;

use backend\components\MyComponent;
use yii\db\Exception;
use Yii;
use yii\helpers\Html;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use backend\components\MyController;
use modava\pages\models\PagesFaq;
use modava\pages\models\search\PagesFaqSearch;

/**
 * FaqController implements the CRUD actions for PagesFaq model.
 */
class FaqController extends MyController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * Updates an existing PagesFaq model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $model = $this->findModel();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('toastr-' . $model->toastr_key . '-form', [
                        'title' => 'Thông báo',
                        'text' => 'Cập nhật thành công',
                        'type' => 'success'
                    ]);
                }
                return $this->refresh();
            } else {
                $errors = Html::tag('p', 'Cập nhật thất bại');
                foreach ($model->getErrors() as $error) {
                    $errors .= Html::tag('p', $error[0]);
                }
                Yii::$app->session->setFlash('toastr-' . $model->toastr_key . '-form', [
                    'title' => 'Thông báo',
                    'text' => $errors,
                    'type' => 'warning'
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the PagesFaq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PagesFaq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel()
    {
        if (($model = PagesFaq::find()->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        // throw new NotFoundHttpException(BackendModule::t('backend','The requested page does not exist.'));
    }
}
