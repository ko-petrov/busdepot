<?php
include("../classes/dbh.classes.php");
include("../classes/trips.classes.php");
include("../classes/driverlist.classes.php");
include("../classes/stops.classes.php");

session_start();
if (!isset($_SESSION['user']['login'])) {
  header('Location: index.php');
  exit();
}
if (isset($_POST['id'])) {
  $id_route = $_POST['id'];
}
elseif (isset($_GET['id'])) {
  $id_route = $_GET['id'];
} else {
  header('Location: driver.php');
  exit();
}

$id_user = $_SESSION['user']['login'];

$my_flight = DriverList::getActive($id_user);

if(empty($my_flight)) {
  header('Location: driver.php');
  exit();
}

$flight_info = DriverList::getByRoute($id_route)[0];
$countFlightTrips = Trips::countFlightTrips($id_route)[0];

$progress = $flight_info['Пройдено_ост'];
$stopsList = Stops::getProgress($flight_info['ИД_маршрут'], $progress);


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Рейс</title>
  <link rel="stylesheet" href="../css/driverflight.css">
  <script async src="../js/nfcscript.js"></script>
</head>
<body>

  <div class="content">
    <div class="flexContent">
      <div class="textButton" onclick="location.href='driver.php';">
        <img src="../media/arrow_back_ios_new_black_24dp.svg">
        <p>назад</p>
      </div>
      <div id="info" class="cardWrapper">
        <div class="card">
          <div class="cardText"><h3>Рейс: <strong id="id_route"><?=$id_route;?></strong> Маршрут: <strong><?=$flight_info['Номер_маршрута'];?></strong></h3></div>
          <div class="cardText">Автобус: <?=$flight_info['ИД_автобус_модель'];?></div>
          <div class="cardText">Выехал: <?=$flight_info['Начало'];?></div>
          <div class="cardText">Диспетчер: <?=$flight_info['ФИО'];?></div>
          <div class="cardText">Телефон: <?=$flight_info['Телефон'];?></div>
        </div>
      </div>
      <div id="stops" class="cardWrapper">
        <div class="card">
          <ul>
            <?php
            $i = 0;
            if ($progress != '0') {
              echo "<li><h2>" . $stopsList[$i]['Название'] . "</h2></li>";
              $i++;
            }
            ?>
            <!-- <h3>cледующая остановка:</h3> -->
            <li id="current">
              <h1><?= $stopsList[$i]['Название'] ?></h1>
              <button form="nextStop" type="submit" class="buttonContained white">
                <img src="../media/route_FILL0_wght600_GRAD0_opsz24.svg">
                <p>ПРИБЫЛ</p>
              </button>
            </li>
            <?php

            $i++;
            while (isset($stopsList[$i])) {
              echo "<li><h2>" . $stopsList[$i]['Название'] . "</h2></li>";
              $i++;
            }

            ?>
          </ul>
        </div>
      </div>
      <div id="tripsCard" class="cardWrapper">
        <div class="card">

          <div class="cardText">Оплата проезда:</div>
          <div class="buttonWrapper">
            <button id="scanButton" class="buttonContained left">
              <img src="../media/contactless_white_24dp.svg">
              <p>КАРТОЙ</p>
            </button>
            
              <input form="nalic" type = "text" name = "id_route" value = "<?=$id_route;?>" hidden />
              <button form="nalic" type="submit" class="buttonContained right">
                <img src="../media/payments_white_24dp.svg">
                <p>НАЛИЧНЫМИ</p>
              </button>
            
          </div>
          <div class="cardText sold">Билетов продано: <strong id="soldTickets"><?=$countFlightTrips['Поездки'];?></strong></div>
<!--           <div class="cardText lastSold">Последний: 12 мин. назад</div> -->
        </div>
      </div>
    </div>
  </div>

  <form id="nalic" action="../inc/new_trip.inc.php" method="post"></form>

  <input form="nextStop" type = "text" name = "id" value = "<?=$id_route;?>" hidden />
  <form id="nextStop" action="../inc/next_stop.inc.php" method="post"></form>




  <!-- <div class="centred-form">
    <div class="centred-form1">
      <div class="centred-form2">
        <h1>Оплата проезда</h1>
        <h3>Наличными или транспротной кратой</h3>
        <br>
        <form class="vertical" action="../inc/new_trip.inc.php" method="post">
          <p>Способ оплаты:</p>
          <select name="sposob">
            <option value="Наличные">Наличные</option>;
            <option value="Проездной">Проездной</option>;
          </select>
          <p>Номер проездного:</p>
          <input type="text" id="result" name="id_ticket" placeholder="Если выбран тип проездной">
          <input type = "text" id="id_route" name = "id_route" value = "<?=$id_route;?>" hidden />

          <button type="submit">Оплатить поездку</button>
          <button id="scanButton" type="button">Прочитать билет (NFC)</button>
        </form>
      </div>
    </div>
  </div> -->

  <div class="nfcerror">
  </div>

  <div class="cardBlockBg">

    <div class="cardBlockContent">
      <div class="goodCardBlock">

        <svg class="busIcon" xmlns="http://www.w3.org/2000/svg" height="100" width="100" viewBox="10 0 40 48"><path d="M12.45 42Q11.8 42 11.3 41.625Q10.8 41.25 10.8 40.65V36.45Q9.35 35.65 8.675 34.15Q8 32.65 8 30.95V11.1Q8 7.4 11.825 5.7Q15.65 4 24.05 4Q32.35 4 36.175 5.7Q40 7.4 40 11.1V30.95Q40 32.65 39.325 34.15Q38.65 35.65 37.2 36.45V40.65Q37.2 41.25 36.7 41.625Q36.2 42 35.55 42H34.6Q33.9 42 33.4 41.625Q32.9 41.25 32.9 40.65V37.9H15.1V40.65Q15.1 41.25 14.6 41.625Q14.1 42 13.4 42ZM24.05 9.8Q29 9.8 32.4 9.8Q35.8 9.8 37 9.8H11Q11.85 9.8 15 9.8Q18.15 9.8 24.05 9.8ZM32.9 24.45H15.1Q13.35 24.45 12.175 24.45Q11 24.45 11 24.45H37Q37 24.45 35.825 24.45Q34.65 24.45 32.9 24.45ZM11 21.45H37V12.8H11ZM16.3 32.4Q17.45 32.4 18.25 31.6Q19.05 30.8 19.05 29.65Q19.05 28.5 18.25 27.7Q17.45 26.9 16.3 26.9Q15.15 26.9 14.35 27.7Q13.55 28.5 13.55 29.65Q13.55 30.8 14.35 31.6Q15.15 32.4 16.3 32.4ZM31.7 32.4Q32.85 32.4 33.65 31.6Q34.45 30.8 34.45 29.65Q34.45 28.5 33.65 27.7Q32.85 26.9 31.7 26.9Q30.55 26.9 29.75 27.7Q28.95 28.5 28.95 29.65Q28.95 30.8 29.75 31.6Q30.55 32.4 31.7 32.4ZM11 9.8H37Q35.8 8.5 32.4 7.75Q29 7 24.05 7Q18.15 7 15 7.675Q11.85 8.35 11 9.8ZM15.1 34.9H32.9Q34.65 34.9 35.825 33.55Q37 32.2 37 30.45V24.45H11V30.45Q11 32.2 12.175 33.55Q13.35 34.9 15.1 34.9Z"/></svg>
        <p id="days">Осталось дней: 4</p>
        <p id="trips">Осталось поездок: 7</p>
      </div>
      <div class="badCardBlock">
        <p>На данной карте нет поездок</p>
      </div>
      <div class="cardBlock">
        <p>Поднесите вашу действующую транспортную карту</p>

      </div>

    </div>
    <div class="nfcReadyMessage">
      <svg class="nfcIcon" xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 48 48"><path d="M29.45 34.4Q30.55 31.9 31.05 29.3Q31.55 26.7 31.55 24Q31.55 21.3 31.05 18.7Q30.55 16.1 29.45 13.65L26.65 14.75Q27.65 16.95 28.1 19.275Q28.55 21.6 28.55 24Q28.55 26.4 28.1 28.75Q27.65 31.1 26.65 33.3ZM22.9 31.6Q23.7 29.8 24.05 27.875Q24.4 25.95 24.4 24Q24.4 22.05 24.05 20.15Q23.7 18.25 22.9 16.45L20.05 17.45Q20.8 19 21.1 20.65Q21.4 22.3 21.4 24Q21.4 25.7 21.075 27.375Q20.75 29.05 20.05 30.6ZM16.1 28.75Q16.6 27.6 16.925 26.425Q17.25 25.25 17.25 24Q17.25 22.75 16.95 21.55Q16.65 20.35 16.05 19.25L13.25 20.25Q13.8 21.1 14.025 22.05Q14.25 23 14.25 24Q14.25 25 13.975 25.95Q13.7 26.9 13.25 27.8ZM24 44Q19.75 44 16.1 42.475Q12.45 40.95 9.75 38.25Q7.05 35.55 5.525 31.9Q4 28.25 4 24Q4 19.8 5.525 16.15Q7.05 12.5 9.75 9.8Q12.45 7.1 16.1 5.55Q19.75 4 24 4Q28.2 4 31.85 5.55Q35.5 7.1 38.2 9.8Q40.9 12.5 42.45 16.15Q44 19.8 44 24Q44 28.25 42.45 31.9Q40.9 35.55 38.2 38.25Q35.5 40.95 31.85 42.475Q28.2 44 24 44ZM23.1 24Q23.1 24 23.1 24Q23.1 24 23.1 24Q23.1 24 23.1 24Q23.1 24 23.1 24Q23.1 24 23.1 24Q23.1 24 23.1 24Q23.1 24 23.1 24Q23.1 24 23.1 24ZM24 41Q31.25 41 36.125 36.125Q41 31.25 41 24Q41 16.75 36.125 11.875Q31.25 7 24 7Q16.75 7 11.875 11.875Q7 16.75 7 24Q7 31.25 11.875 36.125Q16.75 41 24 41Z"/></svg>
      <p class="ready">Оплата проезда при помощи NFC</p>
    </div>
    <div class="backBlock">
      <div class="backBlockBorder">
        <div class="backIcon"></div>
        <a>завершить сканирвоание</a>
      </div>
    </div>
  </div>

</body>
</html>