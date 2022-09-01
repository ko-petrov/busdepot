<?php
	session_start();
	require_once 'connect.php';

	$login = $_POST['login'];
	$password = $_POST['password'];
	$password = md5($password);

	$check_user = sqlsrv_query($conn, "SELECT * FROM Пароли WHERE (ИД_Персонал = '$login') AND (Пароль = '$password')");

	$user = sqlsrv_fetch_array($check_user);
	if ($user) {
		$current_position = "v4";
		$check_position = sqlsrv_query($conn, "SELECT * FROM Водитель WHERE (ИД_Персонал = '$login')");
		$position = sqlsrv_fetch_array($check_position);
		if ($position) {
			$current_position = "v1";
		}
		$check_position = sqlsrv_query($conn, "SELECT * FROM Механик WHERE (ИД_Персонал = '$login')");
		$position = sqlsrv_fetch_array($check_position);
		if ($position) {
			$current_position = "v2";
		}
		$check_position = sqlsrv_query($conn, "SELECT * FROM Диспетчер WHERE (ИД_Персонал = '$login')");
		$position = sqlsrv_fetch_array($check_position);
		if ($position) {
			$current_position = "v3";
		}

		$_SESSION['user'] = [
			"login" => $user['ИД_Персонал'],
			"position" => $current_position
		];
		if ($current_position === "v4") {
			header('Location: ../pages/administrator.php');
		} elseif ($current_position === "v2") {
			header('Location: ../pages/mechanic.php');
		} elseif ($current_position === "v3") {
			header('Location: ../pages/disp.php');
		} elseif ($current_position === "v1") {
			header('Location: ../pages/driver.php');
		} else {
			header('Location: ../profile.php');
		}
	}
	else {
		$_SESSION['message'] = '<p class="msg">Wrong login or password</p>';
    	header('Location: ../index.php');
	}

	print_r($user);
?>