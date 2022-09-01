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
  <title>Авторизация</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Ремонт автобуса</h3>
      <br>
      <form class="vertical" action="../inc/maint_bus.inc.php" method="post">
        <label>Описание:</label>
        <textarea rows="8" name="Описание" placeholder="Например: замена масла"></textarea>
        <input type = "text" name = "id" value = "<?=$edit_bus;?>" hidden />
        <button type="submit">Подтвердить обслуживание</button>
        <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
        ?>
      </form>
    </form>
  </div>
</div>
</body>
</html>
