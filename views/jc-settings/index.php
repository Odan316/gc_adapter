<?php

/**
 * @var $this yii\web\View
 * @var $formModel JcGroupsForm
 */

use app\assets\JcAsset;
use app\models\forms\JcGroupsForm;
use app\models\JcGroup;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

JcAsset::register($this);

$this->title = 'Настройки для Just Click';

$jcGroups = JcGroup::find()->all();


$jcFieldName = Html::getInputName($formModel, 'jcGroups');
$gcFieldName = Html::getInputName($formModel, 'gcGroups');

?>
<div class="site-index">
    <h1><?php echo $this->title; ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form'
    ]); ?>
    <div class="form-group">
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-danger']); ?>
    </div>
    <table class="table table-striped table-condensed jcTable">
        <thead>
        <tr>
            <th>Группа на JustClick</th>
            <th>Группы на GetCourse</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($jcGroups as $i => $jcGroup) { ?>
            <tr>
                <td><?php echo Html::textInput("{$jcFieldName}[{$i}]", $jcGroup->jcId,
                        ['class' => 'form-control jcField']); ?></td>
                <td class="inputsGroup">
                    <?php foreach ($jcGroup->gcGroups as $gcGroup) { ?>
                        <div class="form-group">
                            <?php echo Html::textInput("{$gcFieldName}[{$i}][]", $gcGroup->gcId,
                                ['class' => 'form-control gcField']); ?>
                        </div>
                    <?php } ?>
                </td>
                <td>
                    <?php echo Html::button('Добавить группу', ['class' => 'btn btn-primary btn-xs addGcGroup']) ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="form-group">
        <?php echo Html::button('Добавить строку', ['class' => 'btn btn-success addJcGroup']) ?>
    </div>
    <div class="form-group">
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-danger']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<table class="table hide exampleRow">
    <tr>
        <td><?php echo Html::textInput($jcFieldName, '', ['class' => 'form-control jcField']); ?></td>
        <td class="inputsGroup">
            <div class="form-group">
                <?php echo Html::textInput($jcFieldName, '', ['class' => 'form-control gcField']); ?>
            </div>
        </td>
        <td>
            <?php echo Html::button('Добавить группу', ['class' => 'btn btn-primary btn-xs addGcGroup']) ?>
        </td>
    </tr>
</table>

<div class="exampleGroup hide">
    <div class="form-group">
        <?php echo Html::textInput($gcFieldName, '', ['class' => 'form-control']); ?>
    </div>
</div>