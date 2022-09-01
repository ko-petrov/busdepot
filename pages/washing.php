
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
    <h1>Последние проведения мойки</h1>
    <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
    ?>
    <div class="table_box">
      <?php
      include("../classes/dbh.classes.php");
      include("../classes/washes.classes.php");
      include("../classes/tableView.classes.php");

      $coloumnNames = array("ИД_механик" => "Механик",
                            "Дата" => "Дата",
                            "ИД_автобус" => "Автобус");
      (new TableView(Washes::get(), $coloumnNames))->renderTable();
      ?>
    </div>
  </div>
</body>
</html>