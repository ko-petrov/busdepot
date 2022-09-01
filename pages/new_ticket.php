<?php
  session_start();
  if ($_SESSION['user']['position'] != "v3") {
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
  <title>Дабавление билета</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body class="login">


  <script>
    alert( 'Привет, мир!' );
  </script>

  <form class="form2" action="../inc/new_ticket.inc.php" method="post">
    <label>Начало действия</label>
    <input type="date" name="Дата_начала">
    <label>Конец действия</label>
    <input type="date" name="Дата_окончания">
    <button type="submit">Добавить билет</button>
  	<?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
    ?>
  </form>

</body>
</html>