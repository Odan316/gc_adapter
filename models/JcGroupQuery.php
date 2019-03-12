<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[JcGroup]].
 *
 * @see JcGroup
 */
class JcGroupQuery extends \yii\db\ActiveQuery
{
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

    /**
     * @param $id
     * @return JcGroupQuery
     */
    public function withJcId($id)
    {
        return $this->andWhere(['jcId' => $id]);
    }
}
