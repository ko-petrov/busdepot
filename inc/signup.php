<?php
	session_start();
	require_once 'connect.php';
	
	$login = $_POST['login'];
	$full_name = $_POST['full_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$position = $_POST['position'];
	$experience = $_POST['experience'];
	$adress = $_POST['adress'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	if ($password === $password2) {
		$my_date = date('Y-d-m H:i:s');
		echo $my_date;
		sqlsrv_query($conn, "INSERT INTO Персонал (ИД_Персонал, Стаж, Дата_приёма, Телефон, Email, Адрес, ФИО) VALUES ('$login', '$experience', '$my_date', '$phone', '$email', '$adress', '$full_name')");
		$password =  password_hash($password, PASSWORD_DEFAULT);
		sqlsrv_query($conn, "INSERT INTO Пароли (ИД_Персонал, Пароль) VALUES ('$login', '$password')");
		if ($position === "v1") {
			sqlsrv_query($conn, "INSERT INTO Водитель (ИД_водитель, ИД_Персонал) VALUES ('$login', '$login')");
		} elseif ($position === "v2") {
			sqlsrv_query($conn, "INSERT INTO Механик (ИД_механик, ИД_Персонал) VALUES ('$login', '$login')");
		} elseif ($position === "v3") {
			sqlsrv_query($conn, "INSERT INTO Диспетчер (ИД_диспетчер, ИД_Персонал) VALUES ('$login', '$login')");
		}

		if( ($errors = sqlsrv_errors() ) != null) {
        	foreach( $errors as $error ) {
            	echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            	echo "Код: ".$error[ 'code']."<br />";
            	echo "Сообщение: ".$error[ 'message']."<br />";
        	}
    	}
    	else {
    		$_SESSION['message'] = '<p class="msg2">Successful registration</p>';
    		header('Location: ../pages/administrator.php');
    	}
	}
	else {
		$_SESSION['message'] = 'Passwords do not match';
		header('Location: ../register.php');
	}
?>
