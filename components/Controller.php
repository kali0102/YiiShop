<?php


/**
 * 自定义控制器父类
 * 简化部分操作
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\components;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

class Controller extends \yii\web\Controller
{

    /**
     * 文件上传
     * @param $model AR模型类
     * @param $property AR属性
     * @param null $path 存储目录
     * @throws \yii\base\Exception
     */
    public function fileUpload($model, $property, $path = null)
    {
        $attachment = UploadedFile::getInstance($model, $property);
        if ($attachment != null) {
            $webRoot = Yii::getAlias('@webroot');
            $dir = $path == null ? $property : $path;
            $saveDir = '/upload/' . $dir . '/' . date('Ym');
            if (!is_dir($webRoot . $saveDir))
                FileHelper::createDirectory($webRoot . $saveDir);
            $fileName = Yii::$app->security->generateRandomString(12);
            $filePath = $saveDir . '/' . $fileName . '.' . $attachment->extension;
            if ($attachment->saveAs($webRoot . $filePath))
                $model->$property = $filePath;
            else
                $model->$property = '';
        } else
            $model->$property = '';

    }

    /**
     * 通用查找AR模型数据
     * @param $id 主键ID
     * @return ActiveRecord AR模型数据
     * @throws NotFoundHttpException
     */
    public function loadModel($id)
    {
        $model = null;
        $object = ucfirst(Yii::$app->controller->id);
        $code = '$model = \app\models\\' . $object . '::findOne(' . $id . ');';
        eval($code);
        if ($model === null)
            throw new NotFoundHttpException('', 404);
        return $model;
    }

//    public function loadModel($id, $fields = ['*'], $andWhere = [])
//    {
//        $model = null;
//        $controller = ucfirst(Yii::$app->controller->id);
//        $code = '$model = \app\models\\' . $controller . '::find()';
//        $code .= "->select(['id','name'])";
//        $code .= '->where(["id" => ' . $id . '])';
//        $andWhere ? $code .= '->andWhere(' . $andWhere . ')' : '';
//        $code .= '->one()';
//        echo $code;
////        die;
////        eval($code);
////        if ($model === null)
////            throw new NotFoundHttpException('', 404);
////        return $model;
//    }
}