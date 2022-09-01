<?php

if ( !(isset($_POST['id']) && isset($_POST['pwd'])) ) {
    header("location: ../index.php");
    end();
}
header('Content-Type: application/json; charset=utf-8');

$id = $_POST['id'];
$pwd = $_POST['pwd'];
$flight = $_POST['flight'];


include("../classes/dbh.classes.php");
include("../classes/checkTicket.classes.php");
include("../classes/checkTicket-contr.classes.php");

$ticket = new checkTicketContr($id, $pwd, $flight);

$ticketData = $ticket->getTicket();

if($ticketData) {
    $ticket->checkDate($ticketData);
} else {
    echo "Ошибочка вышлаfffff!";
}


