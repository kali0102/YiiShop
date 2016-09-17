<?php

/**
 * 管理模块
 * 商品规格控制器
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\admini\controllers;

use app\models\SpecValue;
use app\models\Type;
use Yii;
use app\models\Spec;
use app\models\SpecSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SpecController extends Controller {

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
        $searchModel = new SpecSearch();
        $request = Yii::$app->request;
        $dataProvider = $searchModel->search($request->queryParams);
        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

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

    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Spec::findOne($id)) !== null)
            return $model;
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
