<?php
  session_start();
  require_once 'connect.php';
  
  $route = $_POST['ИД_маршрут'];
  $number = $_POST['Номер_маршрута'];
  $interval = $_POST['Интервал'];
  $buscol = $_POST['Нужно_автобусов'];
  $start = $_POST['Начинает_ходить'];
  $stop = $_POST['Заканчивает_ходить'];
  $stopcol = $_POST['Кол_во_остановок'];
  $km = $_POST['Протяженность'];
  $id_route = $_POST['id'];

    sqlsrv_query($conn, "UPDATE Маршрут SET ИД_маршрут = '$route', Номер_маршрута = '$number', Интервал = '$interval', Нужно_автобусов = '$buscol', Начинает_ходить = '$start', Заканчивает_ходить = '$stop', Кол_во_остановок = '$stopcol', Протяженность = '$km'  WHERE (ИД_маршрут = '$id_route')");

    if( ($errors = sqlsrv_errors() ) != null) {
      foreach( $errors as $error ) {
        echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
        echo "Код: ".$error[ 'code']."<br />";
        echo "Сообщение: ".$error[ 'message']."<br />";
      }
    }
    else {
      $_SESSION['message'] = '<p class="msg2">Изменения прошли успешно</p>';
      header('Location: ../pages/routes.php');
    }

?>
