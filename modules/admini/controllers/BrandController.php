<?php

namespace app\modules\admini\controllers;

use Yii;
use app\models\Brand;
use app\models\BrandSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BrandController implements the CRUD actions for Brand model.
 */
class BrandController extends Controller {
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
     * Lists all Brand models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brand model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Brand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Brand();
        $request = Yii::$app->request;
        if ($model->load($request->post())) {
            $thumb = UploadedFile::getInstance($model, 'thumb');
            if ($thumb != null) {
                $webRoot = Yii::getAlias('@webroot');
                $saveDir = '/static/brand/' . date('Y');
                !is_dir($webRoot . $saveDir) ? FileHelper::createDirectory($webRoot . $saveDir) : '';
                $newName = Yii::$app->security->generateRandomString(12);
                $model->thumb = $saveDir . '/' . $newName . '.' . $thumb->extension;
            }
            if ($model->save()) {
                if ($thumb != null)
                    $thumb->saveAs($webRoot . $model->thumb);
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing Brand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $oldThumb = $model->thumb;
        $request = Yii::$app->request;
        if ($model->load($request->post())) {
            $thumb = UploadedFile::getInstance($model, 'thumb');
            if ($thumb != null) {
                $webRoot = Yii::getAlias('@webroot');
                $saveDir = '/static/brand/' . date('Y');
                !is_dir($webRoot . $saveDir) ? FileHelper::createDirectory($webRoot . $saveDir) : '';
                $newName = Yii::$app->security->generateRandomString(12);
                $model->thumb = $saveDir . '/' . $newName . '.' . $thumb->extension;
            }
            if ($model->save()) {
                if ($thumb != null) {
                    @unlink($webRoot . $oldThumb);
                    $thumb->saveAs($webRoot . $model->thumb);
                }
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing Brand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Brand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Brand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Brand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
