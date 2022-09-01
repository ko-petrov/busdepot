<?php
  session_start();
  if ($_SESSION['user']['position'] != "v3") {
    header('Location: ../index.php');
  }
  require_once '../inc/connect.php';

  // $check_bus = sqlsrv_query($conn, "SELECT * FROM Автобус WHERE (ИД_автобус = '$edit_bus')");
  // $bus = sqlsrv_fetch_array($check_bus);
  // if (!$bus) {
  // 	header('Location: mechanic.php');
  // }
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
      <form class="vertical" action="../inc/new_route.inc.php" method="post">
    <label>Идентификатор</label>
    <input type="text" name="ИД_маршрут" placeholder="Введите идентификатор" required>
    <label>Номер маршрута</label>
    <input type="text" name="Номер_маршрута" placeholder="Введите номер">
    <label>Интервал</label>
    <input type="number" name="Интервал" placeholder="Введите интервал">
    <label>Нужно автобусов</label>
    <input type="number" name="Нужно_автобусов" placeholder="Введите количество">
    <label>Начинает ходить</label>
    <input type="time" name="Начинает_ходить" value="06:00">
    <label>Заканчивает ходить</label>
    <input type="time" name="Заканчивает_ходить" value="00:00">
    <label>Кол во остановок</label>
    <input type="number" max="100" min="1" name="Кол_во_остановок"  placeholder="Введите количество" required>
    <label>Протяженность</label>
    <input type="number" name="Протяженность" step="0.1" placeholder="Введите протяженность">
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
