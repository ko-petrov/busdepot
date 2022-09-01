<?php 

// Активные рейсы
class Routes extends Dbh {

	// Мои ктивные рейсы
	static public function getRoutes() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Маршрут');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Начинает_ходить']) {
				$table[$key]['Начинает_ходить'] = (new DateTime($table[$key]['Начинает_ходить']))->format('H:i');
			}
			if ($table[$key]['Заканчивает_ходить']) {
				$table[$key]['Заканчивает_ходить'] = (new DateTime($table[$key]['Заканчивает_ходить']))->format('H:i');
			}
			if ($table[$key]['Протяженность']) {
				$table[$key]['Протяженность'] = round((float)$table[$key]['Протяженность'], 1);
			}
		}
		$stmt = null;
		return $table;
	}

}