<?php
session_start();
if ($_SESSION['user']['position'] != "v3") {
 header('Location: ../index.php');
}
require_once '../inc/connect.php';
if (isset($_SESSION['route'])) {
  $route = $_SESSION['route'];
  unset($_SESSION['route']);
}
else {
  header('Location: routes.php');
}


$table_query = sqlsrv_query($conn, "SELECT Кол_во_остановок FROM Маршрут WHERE ИД_маршрут = '$route'");
$result = sqlsrv_fetch_array($table_query);

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/loginstyle.css">
  <title>Создание маршрута</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Создание маршрута</h3>
      <br>
      <form class="vertical" action="../inc/new_route2.inc.php" method="post">
        <input type = "text" name = "id" value = "<?=$route;?>" hidden />
        <?php
        for ($i = 1; $i <= (int)$result[0]; $i++) {
          echo "<label>Остановка " . $i . "</label>";
          echo "<select name=\"" . $i . "\">";
          $stops_query = sqlsrv_query($conn, "SELECT * FROM Остановка");
          while ($stops = sqlsrv_fetch_array($stops_query)) {
            echo "<option value=\"" . $stops["ИД_остановка"] . "\">" . $stops["ИД_остановка"] . " (" . $stops["Название"] . ")</option>";
          }
          echo "</select>";
        }
        ?>

        <button type="submit">Создать маршрут</button>
        <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
        ?>
      </form>
    </div>
  </div>
</body>
</html>
