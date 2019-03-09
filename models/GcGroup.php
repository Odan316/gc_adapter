<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc_group".
 *
 * @property int $id
 * @property string $gcId
 */
class GcGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gc_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gcId'], 'required'],
            [['gcId'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gcId' => 'Gc ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GcGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GcGroupQuery(get_called_class());
    }
}
