<?php
	session_start();
	require_once 'connect.php';
	
	$id_flight = $_POST['id'];
	$my_date = date('Y-d-m H:i:s');

	sqlsrv_query($conn, "UPDATE Рейс SET Статус = 'Активен', Пройдено_ост = '0', Начало = '$my_date' WHERE ИД_рейс = '$id_flight' ");
	
	if( ($errors = sqlsrv_errors() ) != null) {
       	foreach( $errors as $error ) {
           	echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
           	echo "Код: ".$error[ 'code']."<br />";
           	echo "Сообщение: ".$error[ 'message']."<br />";
       	}
    }
    else {
    	// $_SESSION['message'] = '<p class="msg2">Успешная мойка</p>';
    	header('Location: ../pages/driver.php');
    }

?>
