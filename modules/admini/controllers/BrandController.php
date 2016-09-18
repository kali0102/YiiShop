<?php

/**
 * 管理模块
 * 商品品牌控制器
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\admini\controllers;

use Yii;
use app\models\Brand;
use app\models\BrandSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class BrandController extends Controller {

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

    public function actionIndex() {
        $searchModel = new BrandSearch();
        $request = Yii::$app->request;
        $dataProvider = $searchModel->search($request->queryParams);
        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    // 添加
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

    // 更新
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

    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Brand::findOne($id)) !== null)
            return $model;
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
