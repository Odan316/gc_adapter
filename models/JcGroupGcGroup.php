<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jc_group_gc_group".
 *
 * @property int $jcGroupId
 * @property int $gcGroupId
 */
class JcGroupGcGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jc_group_gc_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jcGroupId', 'gcGroupId'], 'required'],
            [['jcGroupId', 'gcGroupId'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jcGroupId' => 'Jc Group ID',
            'gcGroupId' => 'Gc Group ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return JcGroupGcGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JcGroupGcGroupQuery(get_called_class());
    }
}
