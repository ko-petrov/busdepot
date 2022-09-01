<?php
     $serverName = "DESKTOP-2ETHJV2";
     $connectionInfo = array( "Database"=>"Парк5", "CharacterSet" => "UTF-8");
     $conn = sqlsrv_connect( $serverName, $connectionInfo);

     if ($conn) {
          // echo "Соединение установлено.<br/>";
     }
     else {
          echo "Соединение не установлено.<br/>";
          die(print_r(sqlsrv_errors(),true));
     }
?>