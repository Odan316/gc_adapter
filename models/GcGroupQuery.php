<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GcGroup]].
 *
 * @see GcGroup
 */
class GcGroupQuery extends \yii\db\ActiveQuery
{
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

    /**
     * @param $id
     * @return GcGroupQuery
     */
    public function withGcId($id)
    {
        return $this->andWhere(['gcId' => $id]);
    }
}
