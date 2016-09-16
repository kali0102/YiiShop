<?php

namespace app\modules\admini\controllers;

use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller {
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Category();
        $request = Yii::$app->request;
        if ($model->load($request->post())) {
            $thumb = UploadedFile::getInstance($model, 'thumb');
            if ($thumb != null) {
                $webRoot = Yii::getAlias('@webroot');
                $saveDir = '/static/cate/' . date('Y');
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
     * Updates an existing Category model.
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
                $saveDir = '/static/cate/' . date('Y');
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
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
