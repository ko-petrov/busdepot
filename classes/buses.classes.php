<?php 

// Автобусы
class Buses extends Dbh {

	static public function get() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Автобус');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Дата_покупки']) { $table[$key]['Дата_покупки'] = (new DateTime($table[$key]['Дата_покупки']))->format('d.m.Y'); }
		}
		$stmt = null;
		return $table;
	}

}