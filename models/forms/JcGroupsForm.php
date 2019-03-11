<?php

namespace app\models\forms;

use yii\base\Model;

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
        return [];
    }

    public function save()
    {
        return true;
    }


}