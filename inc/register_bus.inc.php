<?php
	session_start();
	require_once 'connect.php';
	
	$bus = $_POST['ИД_автобус'];
	$model = $_POST['Модель'];
	$date = $_POST['Дата_покупки'];
	$year = $_POST['Год_производства'];
	$rashod = $_POST['Расход_топлива'];
	$srok = $_POST['Срок_службы'];

	$table_query = sqlsrv_query($conn, "SELECT ИД_автобус FROM Автобус WHERE ИД_автобус = '$bus'");
	if (sqlsrv_fetch_array($table_query)) {
		$_SESSION['message'] = '<p class="msg2">Неуникальный идентификатор</p>';
    	header('Location: ../pages/register_bus.php');
	}

	else {
		$datep = strtotime($date);
		$datep = date('Y-d-m H:i:s',$datep);
		sqlsrv_query($conn, "INSERT INTO Автобус (ИД_автобус, Модель, Дата_покупки, Год_производства, Расход_топлива, Срок_службы) VALUES ('$bus', '$model', '$datep', '$year', '$rashod', '$srok')");

		if( ($errors = sqlsrv_errors() ) != null) {
        	foreach( $errors as $error ) {
            	echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            	echo "Код: ".$error[ 'code']."<br />";
            	echo "Сообщение: ".$error[ 'message']."<br />";
        	}
    	}
    	else {
    		$_SESSION['message'] = '<p class="msg2">Автобус зарегистрирован</p>';
    		header('Location: ../pages/mechanic.php');
    	}
	}
?>
