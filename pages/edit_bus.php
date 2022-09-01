<?php
  session_start();
  if ($_SESSION['user']['position'] != "v2") {
    header('Location: ../index.php');
  }
  elseif (isset($_POST['id'])) {
  	$edit_bus = $_POST['id'];
  }
  elseif (isset($_SESSION['id'])) {
  	$edit_bus = $_SESSION['id'];
    unset($_SESSION['id']);
  }
  else {
  	header('Location: mechanic.php');
  }
  require_once '../inc/connect.php';
  // $edit_bus = $_POST['id'];
  $check_bus = sqlsrv_query($conn, "SELECT * FROM Автобус WHERE (ИД_автобус = '$edit_bus')");
  $bus = sqlsrv_fetch_array($check_bus);
  if (!$bus) {
  	header('Location: mechanic.php');
  }
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/loginstyle.css">
  <title>Редактировать автобус</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Редактирование автобуса</h3>
      <br>
      <form class="vertical" action="../inc/edit_bus.inc.php" method="post">
<!--     <label>Login</label>
    <input type="text" name="login" value="<?=$bus['ИД_Персонал'];?>" placeholder="Enter login"> -->
    <label>Модель</label>
    <input type="text" name="Модель" value="<?=$bus['Модель'];?>" placeholder="Введите модель автобуса">
    <label>Год производства</label>
    <input type="number" name="Год_производства" value="<?=$bus['Год_производства'];?>" placeholder="Введите год производства">
    <label>Расход топлива</label>
    <input type="number" name="Расход_топлива" value="<?=$bus['Расход_топлива'];?>" placeholder="Введите расход топлива">
    <label>Срок службы</label>
    <input type="number" name="Срок_службы" value="<?=$bus['Срок_службы'];?>" placeholder="Введите срок службы">
    <input type = "text" name = "id" value = "<?=$edit_bus;?>" hidden />
    <button type="submit">Подтвердить изменения</button>
  </form>
  <form class="vertical" action="../inc/delete_bus.php" method="post">
    <input type = "text" name = "id" value = "<?=$edit_bus;?>" hidden />
    <button type="submit">Списать автобус</button>
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

