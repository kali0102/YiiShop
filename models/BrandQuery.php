<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

class BrandQuery extends ActiveQuery {

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/


    public function all($db = null) {
        return parent::all($db);
    }

    public function one($db = null) {
        return parent::one($db);
    }
}
