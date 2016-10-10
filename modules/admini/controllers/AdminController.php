<?php

/**
 * 管理模块
 * 管理员控制器
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\admini\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\components\Controller;
use app\modules\admini\models\Admin;
use app\modules\admini\models\AdminSearch;

class AdminController extends Controller
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
        $searchModel = new AdminSearch();
        $request = Yii::$app->request;
        $dataProvider = $searchModel->search($request->queryParams);
        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * 详情
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * 添加
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Admin;
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->save())
            return $this->redirect(['index']);
        return $this->render('create', compact('model'));
    }

    /**
     * 编辑
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->save())
            return $this->redirect(['index']);
        return $this->render('create', compact('model'));
    }

    /**
     * 删除
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * 实例化模型
     * @param \app\components\主键ID $id
     * @return static
     * @throws NotFoundHttpException
     */
    public function loadModel($id)
    {
        $model = Admin::findOne($id);
        if ($model === null)
            throw new NotFoundHttpException('', 404);
        return $model;
    }
}
