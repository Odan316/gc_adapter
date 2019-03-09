<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jc_group".
 *
 * @property int $id
 * @property string $jcId
 *
 * @property GcGroup[] $gcGroups
 */
class JcGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jc_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jcId'], 'required'],
            [['jcId'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jcId' => 'Jc ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return JcGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JcGroupQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery|GcGroupQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getGcGroups()
    {
        return $this->hasMany(GcGroup::class, ['id' => 'gcGroupId'])
            ->viaTable(JcGroupGcGroup::tableName(), ['jcGroupId' => 'id']);
    }
}
