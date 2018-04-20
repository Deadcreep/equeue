<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Operator */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Operator';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operator-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $model]); ?>

    <p>
       <?= Html::a('Create Operator', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $model,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idUser',
            'windowId',
            'beginWorkTime',
            'endWorkTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
