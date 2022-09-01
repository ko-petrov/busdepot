<?php
	session_start();
	require_once 'connect.php';

	$start = $_POST['Дата_начала'];
    $end = $_POST['Дата_окончания'];
    $id_stop = $_POST['id'];
  
    $startp = strtotime($start);
    $startp = date('Y-d-m H:i:s',$startp);
  
    $endp = strtotime($end);
    $endp = date('Y-d-m H:i:s',$endp);

	sqlsrv_query($conn, "INSERT INTO Проездной_билет (Дата_начала, Дата_окончания) VALUES ('$startp', '$endp')");
	
	if( ($errors = sqlsrv_errors() ) != null) {
       	foreach( $errors as $error ) {
           	echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
           	echo "Код: ".$error[ 'code']."<br />";
           	echo "Сообщение: ".$error[ 'message']."<br />";
       	}
    }
    else {
    	$_SESSION['message'] = '<p class="msg2">Проездной создан</p>';
	    header('Location: ../pages/tickets.php');
    }

?>
