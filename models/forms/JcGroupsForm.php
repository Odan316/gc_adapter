<?php

namespace app\models\forms;

use app\models\GcGroup;
use app\models\JcGroup;
use app\models\JcGroupGcGroup;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * Class JcGroupsForm
 * @package app\models\forms
 */
class JcGroupsForm extends Model
{
    public $jcGroups = [];
    public $gcGroups = [];

    public function rules()
    {
        return [
            [['jcGroups', 'gcGroups'], 'safe']
        ];
    }

    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function save()
    {
        //VarDumper::dump($this->jcGroups);
        //VarDumper::dump($this->gcGroups);

        $this->updateGcGroups();
        $this->updateJcGroups();

        return true;
    }


    /**
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    private function updateJcGroups()
    {
        $jcGroupsNew = $this->jcGroups;
        $jcGroupsOld = JcGroup::find()->select('jcId')->column();

        $toAdd = array_diff($jcGroupsNew, $jcGroupsOld);
        $toRemove = array_diff($jcGroupsOld, $jcGroupsNew);
        $toEdit = array_intersect($jcGroupsOld, $jcGroupsNew);

        /*VarDumper::dump($jcGroupsNew);
        VarDumper::dump($jcGroupsOld);
        VarDumper::dump($toAdd);
        VarDumper::dump($toRemove);
        VarDumper::dump($toEdit);*/

        foreach ($toAdd as $jcId) {
            if(!empty($jcId)){
                $model = new JcGroup();
                $model->jcId = $jcId;
                $model->save();

                $this->updateLinks($jcId);
            }
        }

        foreach ($toRemove as $jcId) {
            $model = JcGroup::find()->withJcId($jcId)->one();

            $model->delete();
        }

        foreach ($toEdit as $jcId) {
            $this->updateLinks($jcId);
        }
    }

    private function updateGcGroups()
    {
        $gcGroupsNew = [];
        foreach ($this->gcGroups as $data) {
            $gcGroupsNew = array_merge($gcGroupsNew, $data);
        }
        $gcGroupsNew = array_unique($gcGroupsNew);

        $gcGroupsOld = GcGroup::find()->select('gcId')->column();

        $toAdd = array_diff($gcGroupsNew, $gcGroupsOld);

        foreach ($toAdd as $gcId) {
            $model = new GcGroup();
            $model->gcId = $gcId;
            $model->save();
        }
    }

    /**
     * @param $jcId
     * @throws \yii\db\Exception
     */
    private function updateLinks($jcId)
    {
        $jcGroup = JcGroup::find()->withJcId($jcId)->one();
        $gcGroups = GcGroup::find()->withGcId($this->gcGroups[array_search($jcId, $this->jcGroups)])->all();

        $toLink = [];
        foreach ($gcGroups as $gcGroup) {
            $toLink[] = [$jcGroup->id, $gcGroup->id];
        }

        Yii::$app->db->createCommand()->delete(JcGroupGcGroup::tableName(), ['jcGroupId' => $jcGroup->id])->execute();
        Yii::$app->db->createCommand()->batchInsert(JcGroupGcGroup::tableName(), ['jcGroupId', 'gcGroupId'],
            $toLink)->execute();
    }


}