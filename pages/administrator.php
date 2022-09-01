<?php
  session_start();
  if ($_SESSION['user']['position'] != "v4") {
    header('Location: ../index.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Администратор</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <?php include("header.php"); ?>

  <div class="content">
    <h1>Сотрудники предприятия </h1>
    <br>
    <form action="../register.php" method="post">
      <button type="submit">Добавить пользователя</button>
    </form>
    <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
    ?>
    <br>
    <h2>Водители</h2>
    <div class="table_box">
      <?php
      include("../classes/dbh.classes.php");
      include("../classes/staff.classes.php");
      include("../classes/tableView.classes.php");

      $coloumnNames = array("ИД_Персонал" => "Логин",
                            "ФИО" => "Полное имя",
                            "Стаж" => "Стаж",
                            "Дата_приёма" => "Дата приёма",
                            "Телефон" => "Телефон",
                            "Email" => "Email",
                            "Адрес" => "Адрес");
      $primaryKey = "ИД_Персонал";
      $actions = array("edit_profile.php" => "изменить");
      (new TableView(Staff::getDrivers(), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
    </div>
    <h2>Механики</h2>
    <div class="table_box">
      <?php

      $coloumnNames = array("ИД_Персонал" => "Логин",
                            "ФИО" => "Полное имя",
                            "Стаж" => "Стаж",
                            "Дата_приёма" => "Дата приёма",
                            "Телефон" => "Телефон",
                            "Email" => "Email",
                            "Адрес" => "Адрес");
      $primaryKey = "ИД_Персонал";
      $actions = array("edit_profile.php" => "изменить");
      (new TableView(Staff::getMec(), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
    </div>
    <h2>Диспетчеры</h2>
    <div class="table_box">
      <?php

      $coloumnNames = array("ИД_Персонал" => "Логин",
                            "ФИО" => "Полное имя",
                            "Стаж" => "Стаж",
                            "Дата_приёма" => "Дата приёма",
                            "Телефон" => "Телефон",
                            "Email" => "Email",
                            "Адрес" => "Адрес");
      $primaryKey = "ИД_Персонал";
      $actions = array("edit_profile.php" => "изменить");
      (new TableView(Staff::getDisp(), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
    </div>
    <h2>Администраторы</h2>
    <div class="table_box">
      <?php

      $coloumnNames = array("ИД_Персонал" => "Логин",
                            "ФИО" => "Полное имя",
                            "Стаж" => "Стаж",
                            "Дата_приёма" => "Дата приёма",
                            "Телефон" => "Телефон",
                            "Email" => "Email",
                            "Адрес" => "Адрес");
      $primaryKey = "ИД_Персонал";
      $actions = array("edit_profile.php" => "изменить");
      (new TableView(Staff::getAdmins(), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
    </div>
  </div>
</body>
</html>