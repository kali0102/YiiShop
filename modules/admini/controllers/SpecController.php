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


use Yii;
use app\models\Spec;
use app\models\SpecSearch;
use yii\filters\VerbFilter;
use app\models\SpecValue;
use app\models\Type;
use app\components\Controller;

class SpecController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    // 列表
    public function actionIndex()
    {
        $searchModel = new SpecSearch();
        $request = Yii::$app->request;
        $dataProvider = $searchModel->search($request->queryParams);
        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    // 添加
    public function actionCreate()
    {
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

    // 编辑
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
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

    // 删除
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function parseValue($model)
    {
        $values = [];
        if (!empty($model->specValues)) {
            foreach ($model->specValues as $value)
                array_push($values, $value->name);
        }
        return $values;
    }
}
