<?php
session_start();
if ($_SESSION['user']['position'] != "v3") {
  header('Location: ../index.php');
  end();
}
$uid = $_SESSION['user']['login'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Диспетчер</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <?php include("header.php"); ?>
  <div class="content">
    <h1 class="h1WithButton">Мои рейсы</h1>
    <br>
      <form action="new_flight.php?filter=my" method="post">
        <button class="blue" type="submit">Создать рейс</button>
      </form>
    <?php
    if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
    }
    unset($_SESSION['message']);
    ?>
    <h2>Текущие</h2>
    <div class="table_box">
      <?php
      include("../classes/dbh.classes.php");
      include("../classes/flights.classes.php");
      include("../classes/tableView.classes.php");

      $coloumnNames = array("ИД_рейс" => "Рейс", 
                            "ИД_автобус" => "Автобус",
                            "Водитель" => "Водитель",
                            "Телефон" => "Телефон",
                            "ИД_маршрут" => "Маршрут",
                            "Начало" => "Отправился",
                            "Пройдено_ост" => "Пройдено остановок");
      $primaryKey = "ИД_рейс";
      $actions = array("../inc/break_flight.php?filter=my" => "прервать");
      (new TableView(AvtiveFlights::getMyFlights($uid), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
    </div>
    <h2>Будущие</h2>
    <div class="table_box">
      <?php
      $coloumnNames = array("ИД_рейс" => "Рейс", 
                            "ИД_автобус" => "Автобус",
                            "ФИО" => "Водитель",
                            "Телефон" => "Телефон",
                            "ИД_маршрут" => "Маршрут");
      $primaryKey = "ИД_рейс";
      $actions = array("../inc/delete_flight.php?filter=my" => "отменить");
      (new TableView(FutureFlights::getMyFlights($uid), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
    </div>
    <h2>Завершенные</h2>
    <div class="table_box">
      <?php
      $coloumnNames = array("ИД_рейс" => "Рейс", 
                            "ИД_автобус" => "Автобус",
                            "ФИО" => "Водитель",
                            "ИД_маршрут" => "Маршрут",
                            "Начало" => "Начало",
                            "Завершение" => "Завершение",
                            "Пройдено_ост" => "Пройдено остановок",
                            "Статус" => "Статус");
      (new TableView(CompletedFlights::getMyFlights($uid), $coloumnNames))->renderTable();
      ?>
    </div>
  </div>
</body>
</html>