<?php 

// Рейсы водителя
class DriverList extends Dbh {

	static public function getActive($username) {
		$stmt = Dbh::connect()->prepare("SELECT * FROM Список_водителя WHERE Водитель = ? AND Статус = 'Активен'");
		if (!$stmt->execute(array($username))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем дату и время в нужный нам формат
		foreach ($table as $key => $value) {
			foreach ($table[$key] as $key1 => $data) {
				if ($data == '') { $table[$key][$key1] = 'н/д'; }
			}
			if ($table[$key]['Начало']) { $table[$key]['Начало'] = (new DateTime($table[$key]['Начало']))->format('d.m.Y H:i'); } 
			$table[$key]['ИД_автобус_модель'] = $table[$key]['Модель'] . " (" . $table[$key]['ИД_автобус'] . ")";
			$table[$key]['ИД_маршрут_номер'] = $table[$key]['ИД_маршрут'] . " (" . $table[$key]['Номер_маршрута'] . ")";
			$table[$key]['Прогресс'] = $table[$key]['Пройдено_ост'] . " из " . $table[$key]['Кол_во_остановок'];
		}
		$stmt = null;
		return $table;
	}

	

	static public function getByRoute($id_route) {
		$stmt = Dbh::connect()->prepare("SELECT * FROM Список_водителя WHERE ИД_рейс = ? AND Статус = 'Активен'");
		if (!$stmt->execute(array($id_route))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем дату и время в нужный нам формат
		foreach ($table as $key => $value) {
			foreach ($table[$key] as $key1 => $data) {
				if ($data == '') { $table[$key][$key1] = 'н/д'; }
			}
			if ($table[$key]['Начало']) { $table[$key]['Начало'] = (new DateTime($table[$key]['Начало']))->format('d.m.Y H:i'); } 
			$table[$key]['ИД_автобус_модель'] = $table[$key]['Модель'] . " (" . $table[$key]['ИД_автобус'] . ")";
			$table[$key]['ИД_маршрут_номер'] = $table[$key]['ИД_маршрут'] . " (" . $table[$key]['Номер_маршрута'] . ")";
			$table[$key]['Прогресс'] = $table[$key]['Пройдено_ост'] . " из " . $table[$key]['Кол_во_остановок'];
		}
		$stmt = null;
		return $table;
	}

	static public function getFuture($username) {
		$stmt = Dbh::connect()->prepare("SELECT * FROM Список_водителя WHERE Водитель = ? AND Статус = 'Будущий'");
		if (!$stmt->execute(array($username))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($table as $key => $value) {
			$table[$key]['ИД_автобус_модель'] = $table[$key]['ИД_автобус'] . " (" . $table[$key]['Модель'] . ")";
			$table[$key]['ИД_маршрут_номер'] = $table[$key]['ИД_маршрут'] . " (" . $table[$key]['Номер_маршрута'] . ")";
		}
		$stmt = null;
		return $table;
	}

}