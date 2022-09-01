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
  <title>Проездные</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <?php include("header.php"); ?>



  <div class="content">
    <h1>Проездные</h1>
    <br>
    <!-- <form action="new_ticket.php" method="post">
      <button type="submit">Добавить билет</button>
    </form> -->
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
      include("../classes/tickets.classes.php");
      include("../classes/tableView.classes.php");

      $coloumnNames = array("ИД_проездной" => "Билет",
                            "Дата_начала" => "Начало действия",
                            "Дата_окончания" => "Конец действия",
                            "Поездки" => "Поездки",
                          );
      $primaryKey = "ИД_проездной";
      $actions = array("edit_ticket.php" => "продлить", "../inc/delete_ticket.inc.php" => "удалить");
      (new TableView(Tickets::get(), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
  </div>
</body>
</html>