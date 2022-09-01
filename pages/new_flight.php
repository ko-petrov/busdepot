<?php
  session_start();
  if ($_SESSION['user']['position'] != "v3") {
    header('Location: index.php');
  }
  $filter = $_GET['filter'];

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/loginstyle.css">
  <title>Новый рейс</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Новый рейс</h3>
      <br>
      <form class="vertical" action="../inc/new_flight.inc.php?filter=<?php echo $filter; ?>" method="post">
    <label>Автобус</label>
    <select name="bus">
    <?php
    require_once '../inc/connect.php';
    $table_query = sqlsrv_query($conn, "SELECT * FROM Автобус");
    while ($result = sqlsrv_fetch_array($table_query)) {
          if ($result["Дата_покупки"]) { $result["Дата_покупки"] = $result["Дата_покупки"]->format('Y'); }
          echo "<option value=\"" . $result["ИД_автобус"] . "\">" . $result["ИД_автобус"] . " (" . $result["Модель"] . ", " . $result["Дата_покупки"] . ")</option>";
        }
    ?>
    </select>
    <label>Водитель</label>
    <select name="driver">
    <?php
    $table_query = sqlsrv_query($conn, "SELECT * FROM Водитель INNER JOIN Персонал ON Водитель.ИД_Персонал = Персонал.ИД_Персонал");
    while ($result = sqlsrv_fetch_array($table_query)) {
          echo "<option value=\"" . $result["0"] . "\">" . $result["0"] . " (" . $result["ФИО"] . ")</option>";
        }
    ?>
    </select>
    <label>Диспетчер</label>
    <select name="disp">
    <?php
    $table_query = sqlsrv_query($conn, "SELECT * FROM Диспетчер INNER JOIN Персонал ON Диспетчер.ИД_Персонал = Персонал.ИД_Персонал");
    while ($result = sqlsrv_fetch_array($table_query)) {
          echo "<option value=\"" . $result["0"] . "\">" . $result["0"] . " (" . $result["ФИО"] . ")</option>";
        }
    ?>
    </select>
    <label>Маршрут</label>
    <select name="route">
    <?php
    $table_query = sqlsrv_query($conn, "SELECT * FROM Маршрут");
    while ($result = sqlsrv_fetch_array($table_query)) {
          echo "<option value=\"" . $result["0"] . "\">" . $result["0"] . "</option>";
        }
    ?>
    </select>
    <button type="submit">Создать рейс</button>
    <?php
        if (isset($_SESSION['message'])) {
          echo '<p class="msg">' . $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message']);
    ?>
  </form>
    </div>
  </div>
</body>
</html>
