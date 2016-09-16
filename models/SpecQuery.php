<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Spec]].
 *
 * @see Spec
 */
class SpecQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Spec[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Spec|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
