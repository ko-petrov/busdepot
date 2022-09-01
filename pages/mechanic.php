
<?php
  session_start();
  if ($_SESSION['user']['position'] != "v2") {
    header('Location: ../index.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Механик</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <?php include("header.php"); ?>

  <div class="content">
    <h1>Автобусы в штате</h1>
    <br>
    <form action="register_bus.php" method="post">
      <button type="submit">Зарегистрировать новый автобус</button>
    </form>
    <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
    ?>
    <br>
    <h2>Автобусы</h2>
    <div class="table_box">
      <?php
      include("../classes/dbh.classes.php");
      include("../classes/buses.classes.php");
      include("../classes/tableView.classes.php");

      $coloumnNames = array("ИД_автобус" => "id",
                            "Модель" => "Модель",
                            "Дата_покупки" => "Дата закупки",
                            "Год_производства" => "Год производства",
                            "Расход_топлива" => "Расход топлива",
                            "Срок_службы" => "Срок службы");
      $primaryKey = "ИД_автобус";
      $actions = array("../inc/wash_bus.php" => "помыть", "maint_bus.php" => "обслужить", "edit_bus.php" => "редактировать");
      (new TableView(Buses::get(), $coloumnNames, $primaryKey, $actions))->renderTable();
      ?>
    </div>
  </div>
</body>
</html>