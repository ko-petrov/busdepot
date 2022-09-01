<?php
session_start();
if ($_SESSION['user']['position'] != "v2") {
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
  <title>Новый автобус</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Новый автобус</h3>
      <br>
      <form class="vertical" action="../inc/register_bus.inc.php" method="post">
        <label>Уникальный идентификатор автобуса</label>
        <input type="text" name="ИД_автобус" placeholder="Например: B01">
        <label>Модель</label>
        <input type="text" name="Модель" placeholder="Введите модель автобуса">
        <label>Дата покупки</label>
        <input type="date" name="Дата_покупки" placeholder="Введите дату покупки">
        <label>Год производства</label>
        <input type="number" name="Год_производства" placeholder="Введите год производства">
        <label>Расход топлива</label>
        <input type="number" name="Расход_топлива" placeholder="Введите расход топлива">
        <label>Срок службы</label>
        <input type="number" name="Срок_службы" placeholder="Введите срок службы">
        <button type="submit">Зарегистрировать автобус</button>
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
