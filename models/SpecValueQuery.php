<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SpecValue]].
 *
 * @see SpecValue
 */
class SpecValueQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SpecValue[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SpecValue|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
