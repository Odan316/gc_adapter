<?php

/**
 * @var $this yii\web\View
 */

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="jumbotron">
        <h1><?= Yii::$app->name; ?></h1>
        <?php if (Yii::$app->user->isGuest) { ?>
            <p class="lead">Вам необходимо залогиниться для использования утилиты.</p>
        <?php } else { ?>
            <p class="lead">Перейдите в нужную секцию</p>
        <?php } ?>
    </div>
</div>
