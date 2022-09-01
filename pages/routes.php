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
  <title>Маршруты</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <?php include("header.php"); ?>



  <div class="content">
    <h1>Список маршрутов</h1>
    <br>
    <form action="new_route.php" method="post">
      <button type="submit">Создать маршрут</button>
    </form>
    <br>
    <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
    ?>
  
    <div class="table_box">
      <?php
      include("../classes/dbh.classes.php");
      include("../classes/routes.classes.php");
      include("../classes/tableView.classes.php");

      $coloumnNames = array("ИД_маршрут" => "Маршрут",
                            "Номер_маршрута" => "Номер",
                            "Интервал" => "Интервал",
                            "Нужно_автобусов" => "Нужно автобусов",
                            "Начинает_ходить" => "Начинает ходить",
                            "Заканчивает_ходить" => "Заканчивает ходить",
                            "Кол_во_остановок" => "Остановок",
                            "Протяженность" => "Длина");
      $primaryKey = "ИД_маршрут";
      $actions = array("edit_route.php" => "изменить");

      (new TableView(Routes::getRoutes(), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
    </div> 
  </div>
</body>
</html>