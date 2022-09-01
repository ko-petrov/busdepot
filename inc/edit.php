<?php
	session_start();
	require_once 'connect.php';
	
	$edit_user = $_POST['id'];
	// $login = $_POST['login'];
	$full_name = $_POST['full_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	// $position = $_POST['position'];
	$experience = $_POST['experience'];
	$adress = $_POST['adress'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	if ($password === $password2) {
		$my_date = date('Y-d-m H:i:s');
		echo $my_date;
		sqlsrv_query($conn, "UPDATE Персонал SET Стаж = '$experience', Телефон = '$phone', Email = '$email', Адрес = '$adress', ФИО = '$full_name' WHERE (ИД_Персонал = '$edit_user')");
		$password = password_hash($password, PASSWORD_DEFAULT);
		sqlsrv_query($conn, "UPDATE Пароли SET Пароль = '$password' WHERE (ИД_Персонал = '$edit_user')");
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
    		$_SESSION['message'] = '<p class="msg2">Изменения прошли успешно</p>';
    		header('Location: ../pages/administrator.php');
    	}
	}
	else {
		$_SESSION['message'] = '<p class="msg">Passwords do not match</p>';
		$_SESSION['id'] = $edit_user;
		// header('Location: ../pages/administrator.php');
		header('Location: ../pages/edit_profile.php');
	}
?>
