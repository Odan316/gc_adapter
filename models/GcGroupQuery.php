<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GcGroup]].
 *
 * @see GcGroup
 */
class GcGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GcGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GcGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
