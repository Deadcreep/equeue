<?php

$operator = \app\models\Ticket::findOne(Yii::$app->user->getId());
$operator->beginWorkTime=date("y-m-d h:i:s");
$operator->save();