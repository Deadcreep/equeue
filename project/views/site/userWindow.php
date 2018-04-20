<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Operator */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'userWindow';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-userWindow">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Ваш билет с номером <?php
        $ticket = \app\models\Ticket::findOne( Yii::$app->user->id);

        echo $ticket->id?>, ожидайте
    </p>
</div>
