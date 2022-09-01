<?php
	session_start();
	require_once 'connect.php';
	$user_login = $_SESSION['user']['login'];
	$stop = $_POST['ИД_остановка'];
	$name = $_POST['Название'];
	$adress = $_POST['Адрес'];
	$coord = $_POST['Координаты'];

	sqlsrv_query($conn, "INSERT INTO Остановка (ИД_остановка, Название, Адрес, Координаты) VALUES ('$stop', '$name', '$adress', '$coord')");
	
	if( ($errors = sqlsrv_errors() ) != null) {
       	foreach( $errors as $error ) {
           	echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
           	echo "Код: ".$error[ 'code']."<br />";
           	echo "Сообщение: ".$error[ 'message']."<br />";
       	}
    }
    else {
    	$_SESSION['message'] = '<p class="msg2">Оснановка создана</p>';
	    header('Location: ../pages/stops.php');
    }

?>
