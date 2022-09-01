<?php 

// Активные рейсы
class AvtiveFlights extends Dbh {

	// Мои ктивные рейсы
	static public function getMyFlights($uid) {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Активные_рейсы WHERE ИД_Персонал = ?');
		if (!$stmt->execute(array($uid))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем дату и время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Начало']) { $table[$key]['Начало'] = (new DateTime($table[$key]['Начало']))->format('d.m.Y H:i:s'); } 
		}
		$stmt = null;
		return $table;
	}

	// Все ктивные рейсы
	static public function getFlights() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Активные_рейсы');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем дату и время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Начало']) { $table[$key]['Начало'] = (new DateTime($table[$key]['Начало']))->format('d.m.Y H:i:s'); } 
		}
		$stmt = null;
		return $table;
	}

}

// Будущие рейсы
class FutureFlights extends Dbh {

	// Мои будущие рейсы
	static public function getMyFlights($uid) {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Будущие_рейсы WHERE ИД_Персонал = ?');

		if (!$stmt->execute(array($uid))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}

		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		return $table;
	}

	// Все будущие рейсы
	static public function getFlights() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Будущие_рейсы');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		return $table;
	}

}

// Завершенные рейсы
class CompletedFlights extends Dbh {

	// Мои завершенные рейсы
	static public function getMyFlights($uid) {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Завершенные_рейсы WHERE ИД_Персонал = ?');

		if (!$stmt->execute(array($uid))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}

		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем дату и время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Начало']) {
				$table[$key]['Начало'] = (new DateTime($table[$key]['Начало']))->format('d.m.Y H:i:s');
			}
			if ($table[$key]['Завершение']) {
				$table[$key]['Завершение'] = (new DateTime($table[$key]['Завершение']))->format('d.m.Y H:i:s');
			}
		}
		$stmt = null;
		return $table;
	}

	// Все завершенные рейсы
	static public function getFlights() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Завершенные_рейсы');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем дату и время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Начало']) {
				$table[$key]['Начало'] = (new DateTime($table[$key]['Начало']))->format('d.m.Y H:i:s');
			}
			if ($table[$key]['Завершение']) {
				$table[$key]['Завершение'] = (new DateTime($table[$key]['Завершение']))->format('d.m.Y H:i:s');
			}
		}
		$stmt = null;
		return $table;
	}

}