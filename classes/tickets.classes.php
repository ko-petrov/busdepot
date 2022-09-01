<?php 

// Проездные бидеты
class Tickets extends Dbh {

	static public function get() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Проездной_билет');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Дата_начала']) { $table[$key]['Дата_начала'] = (new DateTime($table[$key]['Дата_начала']))->format('d.m.Y H:i:s'); } 
			if ($table[$key]['Дата_окончания']) { $table[$key]['Дата_окончания'] = (new DateTime($table[$key]['Дата_окончания']))->format('d.m.Y H:i:s'); } 
		}
		$stmt = null;
		return $table;
	}

}