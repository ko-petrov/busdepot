<?php

class Trips extends Dbh {

	protected function newTrip() {
		
	}

	static public function countFlightTrips($id_route) {
		$stmt = Dbh::connect()->prepare("SELECT COUNT(*) AS Поездки FROM Поездка WHERE ИД_рейс = ?");
		if (!$stmt->execute(array($id_route))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		return $table;

	}

	static public function lastTrip($id_route) {
		$stmt = Dbh::connect()->prepare("SELECT MAX(Дата_время) AS Дата_время FROM Поездка WHERE WHERE ИД_рейс = ?");
		if (!$stmt->execute(array($id_route))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$stmt = null;
		return $table;
	}

	// 	$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// 	// Преобразуем дату и время в нужный нам формат
	// 	foreach ($table as $key => $value) {
	// 		foreach ($table[$key] as $key1 => $data) {
	// 			if (!$data) { $table[$key][$key1] = 'н/д'; }
	// 		}
	// 		if ($table[$key]['Начало']) { $table[$key]['Начало'] = (new DateTime($table[$key]['Начало']))->format('d.m.Y H:i:s'); } 
	// 		$table[$key]['ИД_автобус_модель'] = $table[$key]['ИД_автобус'] . " (" . $table[$key]['Модель'] . ")";
	// 		$table[$key]['ИД_маршрут_номер'] = $table[$key]['ИД_маршрут'] . " (" . $table[$key]['Номер_маршрута'] . ")";
	// 		$table[$key]['Прогресс'] = $table[$key]['Пройдено_ост'] . " из " . $table[$key]['Кол_во_остановок'];
	// 	}
	// 	$stmt = null;
	// 	return $table;
	// }

}