<?php
session_start();
if ($_SESSION['user']['position'] != "v4") {
  header('Location: ../index.php');
}
elseif (isset($_POST['id'])) {
 $edit_user = $_POST['id'];
}
elseif (isset($_SESSION['id'])) {
 $edit_user = $_SESSION['id'];
 unset($_SESSION['id']);
}
else {
 header('Location: administrator.php');
}
require_once '../inc/connect.php';
  // $edit_user = $_POST['id'];
$check_user = sqlsrv_query($conn, "SELECT * FROM Персонал WHERE (ИД_Персонал = '$edit_user')");
$user = sqlsrv_fetch_array($check_user);
if (!$user) {
 header('Location: administrator.php');
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/loginstyle.css">
  <title>Редактирование пользователя</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Войти в систему</h3>
      <br>
      <form class="vertical" action="../inc/edit.php" method="post">
<!--     <label>Login</label>
  <input type="text" name="login" value="<?=$user['ИД_Персонал'];?>" placeholder="Enter login"> -->
  <label>Full name</label>
  <input type="text" name="full_name" value="<?=$user['ФИО'];?>" placeholder="Enter full name">
  <label>E-mail</label>
  <input type="email" name="email" value="<?=$user['Email'];?>" placeholder="Enter email">
  <label>Phone number</label>
  <input type="tel" name="phone" value="<?=$user['Телефон'];?>" placeholder="Enter phone number">
    <!-- <label>Position</label>
    <select name="position">
      <option disabled>Enter position</option>
      <option value="v1">Driver</option>
      <option value="v2">Mechanic</option>
      <option value="v3">Dispatcher</option>
      <option value="v4">Administrator</option>
    </select> -->
    <label>Experience (years)</label>
    <input type="number" name="experience" value="<?=$user['Стаж'];?>" placeholder="Enter experience">
    <label>Adress</label>
    <input type="text" name="adress" value="<?=$user['Адрес'];?>" placeholder="Enter adress">
    <label>Password</label>
    <input type="password" name="password" placeholder="Enter password">
    <label>Repeat password</label>
    <input type="password" name="password2" placeholder="Repeat password">
    <input type = "text" name = "id" value = "<?=$edit_user;?>" hidden />
    <button type="submit">Confirm</button>
  </form>
  <form class="vertical" action="../inc/delete.php" method="post">
    <input type = "text" name = "id" value = "<?=$edit_user;?>" hidden />
    <button type="submit">Delete user</button>
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
