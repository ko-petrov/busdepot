<?php
    session_start();
    require_once 'connect.php';
    
    $start = $_POST['Дата_начала'];
    $end = $_POST['Дата_окончания'];
    $id = $_POST['id'];
  
    $startp = strtotime($start);
    $startp = date('Y-d-m H:i:s',$startp);
  
    $endp = strtotime($end);
    $endp = date('Y-d-m H:i:s',$endp);

    $number = $_POST['Кол_во_поездок'];
  
    sqlsrv_query($conn, "UPDATE Проездной_билет SET Дата_начала = '$startp', Дата_окончания = '$endp', Поездки = '$number' WHERE (ИД_проездной = '$id')");

    if( ($errors = sqlsrv_errors() ) != null) {
      foreach( $errors as $error ) {
        echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
        echo "Код: ".$error[ 'code']."<br />";
        echo "Сообщение: ".$error[ 'message']."<br />";
      }
    }
    else {
      $_SESSION['message'] = '<p class="msg2">Изменения прошли успешно</p>';
      header('Location: ../pages/tickets.php');
    }

?>
