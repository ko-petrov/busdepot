<?php
	session_start();
	require_once 'connect.php';
	$edit_flight = $_POST['id'];
	sqlsrv_query($conn, "DELETE FROM Рейс WHERE (ИД_рейс = '$edit_flight')");
		// $password = md5($password);
		// sqlsrv_query($conn, "UPDATE Пароли SET Пароль = '$password' WHERE (ИД_Персонал = '$edit_user')");
		// sqlsrv_query($conn, "UPDATE Водитель SET ИД_водитель = '$login' WHERE (ИД_Персонал = '$login')");
		// sqlsrv_query($conn, "UPDATE Механик SET ИД_механик = '$login' WHERE (ИД_Персонал = '$login')");
		// sqlsrv_query($conn, "UPDATE Диспетчер SET ИД_диспетчер = '$login' WHERE (ИД_Персонал = '$login')");

	if( ($errors = sqlsrv_errors() ) != null) {
       	foreach( $errors as $error ) {
           	echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
           	echo "Код: ".$error[ 'code']."<br />";
           	echo "Сообщение: ".$error[ 'message']."<br />";
       	}
    }
    else {
    	$_SESSION['message'] = '<p class="msg2">Рейс удалён</p>';
    	if ($_GET['filter'] === 'all') {
	    	header('Location: ../pages/flights.php');
	    }
	    else {
	    	header('Location: ../pages/disp.php');
	    }
    }

?>
