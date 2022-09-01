<?php
  session_start();
  require_once 'connect.php';
  
  $model = $_POST['Модель'];
  $pr = $_POST['Год_производства'];
  $rashod = $_POST['Расход_топлива'];
  $srok = $_POST['Срок_службы'];
  $id_bus = $_POST['id'];

    sqlsrv_query($conn, "UPDATE Автобус SET Модель = '$model', Год_производства = '$pr', Расход_топлива = '$rashod', Срок_службы = '$srok' WHERE (ИД_автобус = '$id_bus')");

    if( ($errors = sqlsrv_errors() ) != null) {
      foreach( $errors as $error ) {
        echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
        echo "Код: ".$error[ 'code']."<br />";
        echo "Сообщение: ".$error[ 'message']."<br />";
      }
    }
    else {
      $_SESSION['message'] = '<p class="msg2">Изменения прошли успешно</p>';
      header('Location: ../pages/mechanic.php');
    }

?>
