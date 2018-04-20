<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OperatorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Display';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-window">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Ваш билет с номером <?php

        echo '!!!!323231!!!'?>  ожидайте
    </p>
    <div id="display"> </div>

    <script>

        var status = document.querySelector("#display");
        var ws = new WebSocket("tcp://127.0.0.1:1234");
        ws.onopen = function (ev) {
            console.log("Connection established");
        };

        ws.onmessage = function (ev) {
            if(ev.data != ""){
                var tickets = JSON.parse(ev.data);
                var table="";
                for(var i=0;i<tickets.length;++i){
                    if(tickets[i]["idTicketWindow"]){
                        table+="<h1>"+tickets[i]["numberTicket"]+"->"+tickets[i]["idTicketWindow"]
                    }
                }
                status.innerHTML=table;
            }

        };
    </script>


<!--    <table>-->
<!--        --><?php
//
//        $model = \app\models\Tickets::find()
//            ->select('numberTicket, idTicketWindow')
//            ->all();
//        ?>
<!---->
<!--        <tr>-->
<!--            <th><b>Ticket</b></th>-->
<!--            <th><b>Win</b></th>-->
<!--        </tr>-->
<!--        --><?php
//        if ($model)
//            foreach ($model as $m) :?>
<!--                <tr>-->
<!--                    <td>--><?php //echo $m->numberTicket; ?><!--</td>-->
<!--                    <td>--><?php //echo $m->idTicketWindow; ?><!--</td>-->
<!--                </tr>-->
<!--            --><?php //endforeach; ?>
<!---->
<!---->
<!--    </table>-->


</div>
