<?php
	session_start();
	require_once 'connect.php';
	$user_login = $_SESSION['user']['login'];
	$bus = $_POST['bus'];
	$driver = $_POST['driver'];
	$route = $_POST['route'];
	$disp = $_POST['disp'];

	sqlsrv_query($conn, "INSERT INTO Рейс (ИД_автобус, ИД_водитель, ИД_маршрут, ИД_диспетчер, Статус) VALUES ('$bus', '$driver', '$route', '$disp', 'Будущий')");
	
	if( ($errors = sqlsrv_errors() ) != null) {
       	foreach( $errors as $error ) {
           	echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
           	echo "Код: ".$error[ 'code']."<br />";
           	echo "Сообщение: ".$error[ 'message']."<br />";
       	}
    }
    else {
    	$_SESSION['message'] = '<p class="msg2">Рейс создан</p>';
    	if ($_GET['filter'] === 'all') {
	    	header('Location: ../pages/flights.php');
	    }
	    else {
	    	header('Location: ../pages/disp.php');
	    }
    }

?>
