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
  <title>Создание остановки</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Создание остановки</h3>
      <br>
      <form class="vertical" action="../inc/new_stop.inc.php" method="post">
    <label>Идентификатор остановки</label>
    <input type="text" name="ИД_остановка" placeholder="Например: S01">
    <label>Название</label>
    <input type="text" name="Название" placeholder="Введите название">
    <label>Адрес</label>
    <input type="text" name="Адрес" placeholder="Введите адрес">
    <label>Координаты</label>
    <input type="text" name="Координаты" placeholder="Введите координаты">
    
    <button type="submit">Создать остановку</button>
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
