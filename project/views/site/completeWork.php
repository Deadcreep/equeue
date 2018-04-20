<?php

use app\models\Operator;

$operator = Operator::findOne(Yii::$app->user->getId());
$operator->completeWork=date("y-m-d h:i:s");
$operator->save();
