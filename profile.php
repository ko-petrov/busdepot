<?php
  session_start();
  if (!isset($_SESSION['user'])) {
    header('Location: /index.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Профиль</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body class="login">
  <div>
    <p>Hello, <?= $_SESSION['user']['login'] ?>!</p>
    <p>You are , <?= $_SESSION['user']['position'] ?>!</p>
    <form action="inc/logout.php" method="post">
      <button type="submit">Log out</button>
    </form>
  </div>
</body>
</html>