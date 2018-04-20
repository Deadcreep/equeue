<?php


use app\models\Ticket;


if(isset($_POST['get_ticket'])){
    echo Ticket::newTicket();
}


