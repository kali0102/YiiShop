<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AttributeValue]].
 *
 * @see AttributeValue
 */
class AttributeValueQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AttributeValue[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AttributeValue|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
