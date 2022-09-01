<?php
  session_start();
  if ($_SESSION['user']['position'] != "v1") {
    header('Location: ../index.php');
  }
  $username = $_SESSION['user']['login'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Водитель</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <?php include("header.php"); ?>



  <div class="content">
    <h1>Мои Рейсы</h1>
    </form>
    <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
    ?>
    <br>
    <h2>Текущие</h2>
    <div class="table_box">
      <?php
      include("../classes/dbh.classes.php");
      include("../classes/driverlist.classes.php");
      include("../classes/tableView.classes.php");

      $coloumnNames = array("ИД_рейс" => "Рейс",
                            "ИД_автобус_модель" => "Автобус",
                            "ИД_маршрут_номер" => "Маршрут",
                            // "ФИО" => "Диспетчер",
                            // "Телефон" => "Телефон диспетчера",
                            // "Начало" => "Начало",
                            // "Прогресс" => "Пройдено (ост.)",
                          );
      $primaryKey = "ИД_рейс";
      // "../inc/next_stop.inc.php" => "след. остановка",
      $actions = array( "driverflight.php" => "подробности");
      (new TableView(DriverList::getActive($username), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
  </div>
  <h2>Будущие</h2>
    <div class="table_box">
      <?php
      $coloumnNames = array("ИД_рейс" => "Рейс",
                            "ИД_автобус_модель" => "Автобус",
                            "ИД_маршрут_номер" => "Маршрут",
                            // "ФИО" => "Диспетчер",
                            // "Телефон" => "Телефон диспетчера",
                          );
      $primaryKey = "ИД_рейс";
      $actions = array("../inc/driver_start.inc.php" => "начать");
      (new TableView(DriverList::getFuture($username), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
  </div>
</body>
</html>