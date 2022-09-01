<?php
	session_start();
	require_once 'connect.php';
	$user_login = $_SESSION['user']['login'];
	$id_route = $_POST['id_route'];
	$my_date = date('Y-d-m H:i:s');

	sqlsrv_query($conn, "INSERT INTO Поездка (Способ_оплаты, Дата_время, ИД_рейс) VALUES ('Наличные', '$my_date', '$id_route')");
	
	if( ($errors = sqlsrv_errors() ) != null) {
       	foreach( $errors as $error ) {
           	echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
           	echo "Код: ".$error[ 'code']."<br />";
           	echo "Сообщение: ".$error[ 'message']."<br />";
       	}
    }
    else {
	    header('Location: ../pages/driverflight.php?id=' . $id_route);
    }

?>
