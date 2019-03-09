<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[JcGroup]].
 *
 * @see JcGroup
 */
class JcGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return JcGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return JcGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
