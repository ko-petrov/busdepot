<?php
  session_start();
  if ($_SESSION['user']['position'] != "v3") {
    header('Location: ../index.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Остановки</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <?php include("header.php"); ?>



  <div class="content">
    <h1>Остановки</h1>
    <br>
    <form action="new_stop.php" method="post">
      <button type="submit">Добавить остановку</button>
    </form>
    <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
    ?>
    <br>
    <div class="table_box">
      <?php
      include("../classes/dbh.classes.php");
      include("../classes/stops.classes.php");
      include("../classes/tableView.classes.php");

      $coloumnNames = array("ИД_остановка" => "Идентификатор",
                            "Название" => "Название",
                            "Адрес" => "Адрес",
                            "Координаты" => "Координаты");
      $primaryKey = "ИД_остановка";
      $actions = array("edit_stop.php" => "редактировать", "../inc/delete_stop.php" => "удалить");

      (new TableView(Stops::getStops(), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
    </div>
  </div>


</body>
</html>