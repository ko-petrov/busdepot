<?php
  session_start();
  if ($_SESSION['user']['position'] != "v3") {
    header('Location: ../index.php');
  }
  elseif (isset($_POST['id'])) {
  	$edit_stop = $_POST['id'];
  }
  elseif (isset($_SESSION['id'])) {
  	$edit_stop = $_SESSION['id'];
    unset($_SESSION['id']);
  }
  else {
  	header('Location: stops.php');
  }
  require_once '../inc/connect.php';
  // $edit_stop = $_POST['id'];
  $check_stop = sqlsrv_query($conn, "SELECT * FROM Остановка WHERE (ИД_остановка = '$edit_stop')");
  $stop = sqlsrv_fetch_array($check_stop);
  if (!$stop) {
  	header('Location: stops.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/loginstyle.css">
  <title>Редактирование остановки</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Редактирование остановки</h3>
      <br>
      <form class="vertical" action="../inc/edit_stop.inc.php" method="post">
<!--     <label>Login</label>
    <input type="text" name="login" value="<?=$bus['ИД_Персонал'];?>" placeholder="Enter login"> -->
    <label>Идентификатор</label>
    <input type="text" name="ИД_остановка" value="<?=$stop['ИД_остановка'];?>" placeholder="Введите идентификатор">
    <label>Название</label>
    <input type="text" name="Название" value="<?=$stop['Название'];?>" placeholder="Введите название">
    <label>Адрес</label>
    <input type="text" name="Адрес" value="<?=$stop['Адрес'];?>" placeholder="Введите адрес">
    <label>Координаты</label>
    <input type="text" name="Координаты" value="<?=$stop['Координаты'];?>" placeholder="Введите координаты">
    <input type = "text" name = "id" value = "<?=$edit_stop;?>" hidden />
    <button type="submit">Подтвердить изменения</button>
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