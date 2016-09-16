<?php

namespace app\modules\admini\controllers;

use app\models\SpecValue;
use app\models\Type;
use Yii;
use app\models\Spec;
use app\models\SpecSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SpecController implements the CRUD actions for Spec model.
 */
class SpecController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Spec models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SpecSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Spec model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Spec model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Spec();
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->save()) {
            $values = explode(',', $model->values);
            if (!empty($values)) {
                $specValue = new SpecValue;
                foreach ($values as $value) {
                    $_model = clone $specValue;
                    $_model->spec_id = $model->primaryKey;
                    $_model->name = $value;
                    $_model->save();
                }
            }
            return $this->redirect(['index']);
        }
        return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing Spec model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->save()) {
            $values = explode(',', $model->values);
            if (!empty($values)) {
                $specValue = new SpecValue;
                foreach ($values as $value) {
                    $_model = clone $specValue;
                    $_model->spec_id = $model->primaryKey;
                    $_model->name = $value;
                    $_model->save();
                }
            }
            return $this->redirect(['index']);
        }
        return $this->render('create', compact('model'));
    }

    /**
     * Deletes an existing Spec model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Spec model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Spec the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Spec::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
