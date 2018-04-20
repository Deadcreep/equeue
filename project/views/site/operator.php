<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Operators;

/* @var $this yii\web\View */
/* @var $model app\models\Operator */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'operator';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operator-index">

    <h1><?= "Привет, " . Yii::$app->user->identity->name . " " . Yii::$app->user->identity->surname ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php \yii\widgets\Pjax::begin(); ?>


    <form action="../views/site/completeWork.php" method="post">
        <p><input type='submit' name='submit' value='End work'></p>
    </form>
    <form action="../views/site/updateDate.php" method="post">
        <p><input type='submit' name='submit' value='Start work'></p>
    </form>
    <form action="../views/site/updateDate.php" method="post">
        <p><input type='submit' name='submit' value='Freedom'></p>
    </form>


    <?php \yii\widgets\Pjax::end(); ?>

    <table>
        <?php

        $model = \app\models\Ticket::find()
            ->select('numberTicket, createDate, idTicketWindow')
            ->all();
        ?>

        <tr>
            <th><b>Ticket</b></th>
            <th><b>createDate</b></th>
            <th><b>Win</b></th>
        </tr>
        <?php
        if ($model)
            foreach ($model as $m) :?>
                <tr>
                    <td><?php echo $m->numberTicket; ?></td>
                    <td><?php echo $m->createDate; ?></td>
                    <td><?php echo $m->idTicketWindow; ?></td>
                </tr>
            <?php endforeach; ?>
    </table>
</div>
