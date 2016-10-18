<?php

/**
 * 管理模块
 * 商品属性控制器
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\admini\controllers;

use Yii;
use app\models\Attribute;
use app\models\AttributeSearch;
use yii\filters\VerbFilter;
use app\components\Controller;
use app\models\AttributeValue;

class AttributeController extends Controller
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

    /**
     * 列表
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AttributeSearch;
        $request = Yii::$app->request;
        $dataProvider = $searchModel->search($request->queryParams);
        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * 添加
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Attribute;
        $model->loadDefaultValues();
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->save())
            return $this->redirect(['index']);
        return $this->render('create', compact('model'));
    }


    /**
     * 编辑
     * @param $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->save())
            return $this->redirect(['index']);
        return $this->render('update', compact('model'));
    }

    /**
     * 删除
     * @param $id
     * @return \yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function parseValue($model)
    {
        $values = [];
        if (!empty($model->attributeValues)) {
            foreach ($model->attributeValues as $value)
                array_push($values, $value->name);
        }
        return $values;
    }
}
