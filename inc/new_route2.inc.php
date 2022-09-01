<?php
	session_start();
	require_once 'connect.php';
	print_r($_POST);
	echo key($_POST);
    $id = current($_POST);
    next($_POST);
	while (current($_POST)) {
        $index = key($_POST);
        $bus_stop_id = current($_POST);
        sqlsrv_query($conn, "INSERT INTO Остановка_Маршрут (ИД_маршрут, ИД_остановка, Порядок) VALUES ('$id', '$bus_stop_id', '$index')");
        next($_POST);
    }
    
	if( ($errors = sqlsrv_errors() ) != null) {
       	foreach( $errors as $error ) {
           	echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
           	echo "Код: ".$error[ 'code']."<br />";
           	echo "Сообщение: ".$error[ 'message']."<br />";
       	}
    }
    else {
    	$_SESSION['message'] = '<p class="msg2">Успешное создание маршрута</p>';
	    header('Location: ../pages/routes.php');
    }

?>
