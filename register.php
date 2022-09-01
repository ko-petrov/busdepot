<?php
  session_start();
  if ($_SESSION['user']['position'] != "v4") {
    header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/loginstyle.css">
  <title>Регистрация</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Регистрация нового пользователя</h3>
      <br>
      <form class="vertical" action="inc/signup.php" method="post">
    <label>Login</label>
    <input type="text" name="login" placeholder="Enter login">
    <label>Full name</label>
    <input type="text" name="full_name" placeholder="Enter full name">
    <label>E-mail</label>
    <input type="email" name="email" placeholder="Enter email">
    <label>Phone number</label>
    <input type="tel" name="phone" placeholder="Enter phone number">
    <label>Position</label>
    <select name="position">
      <option disabled>Enter position</option>
      <option value="v1">Driver</option>
      <option value="v2">Mechanic</option>
      <option value="v3">Dispatcher</option>
      <option value="v4">Administrator</option>
    </select>
    <label>Experience (years)</label>
    <input type="number" name="experience" placeholder="Enter experience">
    <label>Adress</label>
    <input type="text" name="adress" placeholder="Enter adress">
    <label>Password</label>
    <input type="password" name="password" placeholder="Enter password">
    <label>Repeat password</label>
    <input type="password" name="password2" placeholder="Repeat password">
    <button type="submit">Register</button>
    <!-- <p>
      Already have an account? <a href="index.php">Log in!</a>
    </p> -->
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
