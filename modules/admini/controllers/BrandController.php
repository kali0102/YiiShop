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

use Overtrue\Pinyin\Pinyin;
use Yii;
use app\models\Brand;
use app\models\BrandSearch;
use yii\filters\VerbFilter;

use app\components\Controller;

class BrandController extends Controller
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
        $searchModel = new BrandSearch();
        $request = Yii::$app->request;
        $dataProvider = $searchModel->search($request->queryParams);
        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    // 添加
    public function actionCreate()
    {
        $model = new Brand();
        $request = Yii::$app->request;
        if ($model->load($request->post())) {
            $this->fileUpload($model, 'thumb');
            $pinyin = new Pinyin;
            $letter = substr(strtoupper($pinyin->abbr($model->name)), 0, 1);
            $model->letter = $letter;
            if ($model->save())
                return $this->redirect(['index']);

        }
        return $this->render('create', compact('model'));
    }

    // 更新
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $request = Yii::$app->request;
        if ($model->load($request->post())) {
            $this->fileUpload($model, 'thumb');
            $pinyin = new Pinyin;
            $letter = substr(strtoupper($pinyin->abbr($model->name)), 0, 1);
            $model->letter = $letter;
            if ($model->save())
                return $this->redirect(['index']);

        }
        return $this->render('update', compact('model'));
    }

    // 删除
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        return $this->redirect(['index']);
    }

}
