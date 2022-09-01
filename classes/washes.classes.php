<?php 

// Мойка
class Washes extends Dbh {

	static public function get() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Мойка');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Дата']) { $table[$key]['Дата'] = (new DateTime($table[$key]['Дата']))->format('d.m.Y'); }
		}
		$stmt = null;
		return $table;
	}

}