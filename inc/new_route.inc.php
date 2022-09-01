<?php
	session_start();
	require_once 'connect.php';
	$route = $_POST['ИД_маршрут'];
  	$number = $_POST['Номер_маршрута'];
  	$interval = $_POST['Интервал'];
  	$buscol = $_POST['Нужно_автобусов'];
  	$start = $_POST['Начинает_ходить'];
  	$stop = $_POST['Заканчивает_ходить'];
  	$stopcol = $_POST['Кол_во_остановок'];
  	$km = $_POST['Протяженность'];

	sqlsrv_query($conn, "INSERT INTO Маршрут (ИД_маршрут, Номер_маршрута, Интервал, Нужно_автобусов, Начинает_ходить, Заканчивает_ходить, Кол_во_остановок, Протяженность) VALUES ('$route', '$number', '$interval', '$buscol', '$start', '$stop', '$stopcol', '$km')");
	
	if( ($errors = sqlsrv_errors() ) != null) {
       	foreach( $errors as $error ) {
           	echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
           	echo "Код: ".$error[ 'code']."<br />";
           	echo "Сообщение: ".$error[ 'message']."<br />";
       	}
    }
    else {
    	$_SESSION['route'] = $route;
	    header('Location: ../pages/new_route2.php');
    }

?>
