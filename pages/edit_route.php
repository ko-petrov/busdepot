<?php
  session_start();
  if ($_SESSION['user']['position'] != "v3") {
    header('Location: ../index.php');
  }
  elseif (isset($_POST['id'])) {
  	$edit_route = $_POST['id'];
  }
  elseif (isset($_SESSION['id'])) {
  	$edit_route = $_SESSION['id'];
    unset($_SESSION['id']);
  }
  else {
  	header('Location: routes.php');
  }
  require_once '../inc/connect.php';
  // $edit_stop = $_POST['id'];
  $check_route = sqlsrv_query($conn, "SELECT * FROM Маршрут WHERE (ИД_маршрут = '$edit_route')");
  $route = sqlsrv_fetch_array($check_route);
  if (!$route) {
  	header('Location: routes.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/loginstyle.css">
  <title>Редактирование маршрута</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Редактирование маршрута</h3>
      <br>
      <form class="vertical" action="../inc/edit_route.inc.php" method="post">
    <label>Идентификатор</label>
    <input type="text" name="ИД_маршрут" value="<?=$route['ИД_маршрут'];?>" placeholder="Введите идентификатор">
    <label>Номер маршрута</label>
    <input type="text" name="Номер_маршрута" value="<?=$route['Номер_маршрута'];?>" placeholder="Введите номер">
    <label>Интервал</label>
    <input type="number" name="Интервал" value="<?=$route['Интервал'];?>" placeholder="Введите интервал">
    <label>Нужно автобусов</label>
    <input type="number" name="Нужно_автобусов" value="<?=$route['Нужно_автобусов'];?>" placeholder="Введите количество">
    <label>Начинает ходить</label>
    <input type="time" name="Начинает_ходить" placeholder="Введите время">
    <label>Заканчивает ходить</label>
    <input type="time" name="Заканчивает_ходить" placeholder="Введите время">
    <label>Кол во остановок</label>
    <input type="number" max="100" min="1" name="Кол_во_остановок" value="<?=$route['Кол_во_остановок'];?>" placeholder="Введите количество">
    <label>Протяженность</label>
    <input type="number" name="Протяженность" step="0.1" value="<?=$route['Протяженность'];?>" placeholder="Введите протяженность">
    <input type = "text" name = "id" value = "<?=$edit_route;?>" hidden />
    <button type="submit">Подтвердить изменения</button>
  </form>
    <form class="vertical" action="../inc/delete_route.inc.php" method="post">
    <input type = "text" name = "id" value = "<?=$edit_route;?>" hidden />
    <button type="submit">Удалить маршрут</button>
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
