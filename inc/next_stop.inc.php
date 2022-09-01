<?php
	session_start();
	require_once 'connect.php';
	
	$id_flight = $_POST['id'];

	$table_query = sqlsrv_query($conn, "SELECT Пройдено_ост, Кол_во_остановок FROM Список_водителя WHERE (ИД_рейс = '$id_flight')");
	$result = sqlsrv_fetch_array($table_query);

	$my_date = date('Y-d-m H:i:s');
	(int)$pr_ost =  $result['Пройдено_ост'];
	(int)$kol_ost =  $result['Кол_во_остановок'];

	if ($pr_ost < $kol_ost - 1) {
		$pr_ost++;
		sqlsrv_query($conn, "UPDATE Рейс SET Пройдено_ост = '$pr_ost' WHERE ИД_рейс = '$id_flight' ");
		header('Location: ../pages/driverflight.php?id=' . $id_flight);
		die();
	}
	else {
		$pr_ost++;
		sqlsrv_query($conn, "UPDATE Рейс SET Статус = 'Завершен', Пройдено_ост = '$pr_ost', Завершение = '$my_date' WHERE ИД_рейс = '$id_flight' ");
		header('Location: ../pages/driver.php?flstatus=finished');
		die();
	}

    

?>
