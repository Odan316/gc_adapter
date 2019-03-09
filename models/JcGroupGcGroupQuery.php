<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[JcGroupGcGroup]].
 *
 * @see JcGroupGcGroup
 */
class JcGroupGcGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return JcGroupGcGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return JcGroupGcGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
