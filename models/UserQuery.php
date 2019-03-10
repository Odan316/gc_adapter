<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[User]].
 *
 * @see User
 *
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 * @since 1.0
 */
class UserQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $id
     * @return UserQuery
     */
    public function withId($id)
    {
        return $this->andWhere(['id' => $id]);
    }
}