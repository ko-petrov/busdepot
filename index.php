<?php
  session_start();
  if (isset($_SESSION['user']['login'])) {
    switch ($_SESSION['user']['position']) {
    case "v1": header('Location: pages/driver.php'); break;
    case "v2": header('Location: pages/mechanic.php'); break;
    case "v3": header('Location: pages/disp.php'); break;
    case "v4": header('Location: pages/administrator.php'); break;
    default: header('Location: profile.php');
    }
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/loginstyle.css">
  <title>Авторизация</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Войти в систему</h3>
      <br>
      <form class="vertical" action="inc/login.inc.php" method="post">
        <input type="text" name="login" autofocus placeholder="Введите логин">
        <input type="password" name="password" placeholder="Введите пароль">
        <button type="submit" name="submit">Войти</button>
      </form>
      <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
      ?>
    </div>
  </div>
</body>
</html>