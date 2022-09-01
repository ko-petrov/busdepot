<?php
  session_start();
  if ($_SESSION['user']['position'] != "v3") {
    header('Location: ../index.php');
  }
  elseif (isset($_POST['id'])) {
  	$edit_ticket = $_POST['id'];
  }
  elseif (isset($_SESSION['id'])) {
  	$edit_ticket = $_SESSION['id'];
    unset($_SESSION['id']);
  }
  else {
  	header('Location: tickets.php');
  }
  require_once '../inc/connect.php';
  // $edit_ticket = $_POST['id'];
  $check_ticket = sqlsrv_query($conn, "SELECT * FROM Проездной_билет WHERE (ИД_проездной = '$edit_ticket')");
  $ticket = sqlsrv_fetch_array($check_ticket);
  if (!$ticket) {
  	header('Location: tickets.php');
  }

  $my_date = date('Y-m-d');
  $next_date = date("Y-m-d", strtotime("+1 month"))
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/loginstyle.css">
  <title>Пополнение проездного</title>
</head>
<body>
  <div class="centred-form">
    <div class="centred-form2">
      <h1>Автобусный парк</h1>
      <h3>Пополнение проездного №<?= $edit_ticket ?></h3>
      <br>
      <form class="vertical" action="../inc/edit_ticket.inc.php" method="post">
<!--     <label>Login</label>
    <input type="text" name="login" value="<?=$bus['ИД_Персонал'];?>" placeholder="Enter login"> -->
    <label>Начало действия</label>
    <input type="date" name="Дата_начала" value="<?= $my_date ?>" min="<?= $my_date ?>">
    <label>Конец действия</label>
    <input type="date" name="Дата_окончания" value="<?= $next_date ?>" min="<?= $my_date ?>">
    <label>Количество поездок</label>
    <input type="number" max="100" min="1" value="15" name="Кол_во_поездок"  placeholder="Введите количество" required>
    <input type = "text" name = "id" value = "<?=$edit_ticket;?>" hidden />
    <button type="submit">Подтвердить изменения</button>
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