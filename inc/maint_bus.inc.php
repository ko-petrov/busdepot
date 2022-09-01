<?php
	session_start();
	require_once 'connect.php';
	
	$user_login = $_SESSION['user']['login'];
	$description = $_POST['Описание'];
	$id_bus = $_POST['id'];
	$my_date = date('Y-d-m H:i:s');
	echo $my_date;

	$table_query = sqlsrv_query($conn, "SELECT ИД_механик FROM Механик WHERE (ИД_Персонал = '$user_login')");
	$result = sqlsrv_fetch_array($table_query);
	$mech_login = $result['ИД_механик'];
	sqlsrv_query($conn, "INSERT INTO Тех_обслуживание (ИД_механик, Дата, ИД_автобус, Описание) VALUES ('$mech_login', '$my_date', '$id_bus', '$description')");
	
	if( ($errors = sqlsrv_errors() ) != null) {
       	foreach( $errors as $error ) {
           	echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
           	echo "Код: ".$error[ 'code']."<br />";
           	echo "Сообщение: ".$error[ 'message']."<br />";
       	}
    }
    else {
    	$_SESSION['message'] = '<p class="msg2">Успешное техобслуживание</p>';
    	header('Location: ../pages/mechanic.php');
    }

?>
