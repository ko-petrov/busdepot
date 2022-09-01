<?php
  session_start();
  require_once 'connect.php';
  
  $ost = $_POST['ИД_остановка'];
  $name = $_POST['Название'];
  $adress = $_POST['Адрес'];
  $coord = $_POST['Координаты'];
  $id_stop = $_POST['id'];

    sqlsrv_query($conn, "UPDATE Остановка SET ИД_остановка = '$ost', Название = '$name', Адрес = '$adress', Координаты = '$coord' WHERE (ИД_остановка = '$id_stop')");

    if( ($errors = sqlsrv_errors() ) != null) {
      foreach( $errors as $error ) {
        echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
        echo "Код: ".$error[ 'code']."<br />";
        echo "Сообщение: ".$error[ 'message']."<br />";
      }
    }
    else {
      $_SESSION['message'] = '<p class="msg2">Изменения прошли успешно</p>';
      header('Location: ../pages/stops.php');
    }

?>
