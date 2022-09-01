<?php

include("../classes/headerView.classes.php");

$uid = $_SESSION['user']['login'];
$position = $_SESSION['user']['position'];
$page = strtok($_SERVER["REQUEST_URI"], '?');

$header = new Header($position, $uid, $page);
$header->renderHeader();

?>