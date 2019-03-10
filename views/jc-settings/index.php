<?php

/**
 * @var $this yii\web\View
 */

use app\models\JcGroup;

$this->title = 'Настройки для Just Click';

$jcGroups = JcGroup::find()->all(); ?>
<div class="site-index">
    <h1><?= Yii::$app->name; ?></h1>

    <?php foreach($jcGroups as $jcGroup) { ?>

    <?php }?>
</div>
