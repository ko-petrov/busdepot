<?php 

// Персонал
class Staff extends Dbh {

	// Только водители
	static public function getDrivers() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Персонал inner join Водитель on Персонал.ИД_Персонал = Водитель.ИД_Персонал');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем дату и время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Дата_приёма']) { $table[$key]['Дата_приёма'] = (new DateTime($table[$key]['Дата_приёма']))->format('d.m.Y'); } 
		}
		$stmt = null;
		return $table;
	}

	// Только механики
	static public function getMec() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Персонал inner join Механик on Персонал.ИД_Персонал = Механик.ИД_Персонал');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем дату и время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Дата_приёма']) { $table[$key]['Дата_приёма'] = (new DateTime($table[$key]['Дата_приёма']))->format('d.m.Y'); } 
		}
		$stmt = null;
		return $table;
	}

	// Только диспетчеры
	static public function getDisp() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Персонал inner join Диспетчер on Персонал.ИД_Персонал = Диспетчер.ИД_Персонал');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Преобразуем дату и время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Дата_приёма']) { $table[$key]['Дата_приёма'] = (new DateTime($table[$key]['Дата_приёма']))->format('d.m.Y'); } 
		}
		$stmt = null;
		return $table;
	}

	// Только админы
	static public function getAdmins() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Персонал
                  left join Водитель on Персонал.ИД_Персонал = Водитель.ИД_Персонал
                  left join Механик on Персонал.ИД_Персонал = Механик.ИД_Персонал
                  left join Диспетчер on Персонал.ИД_Персонал = Диспетчер.ИД_Персонал
                  WHERE (Водитель.ИД_Персонал IS NULL) AND  (Механик.ИД_Персонал IS NULL) AND (Диспетчер.ИД_Персонал IS NULL)');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_NAMED);
		// Преобразуем дату и время в нужный нам формат
		foreach ($table as $key => $value) {
			if ($table[$key]['Дата_приёма']) { $table[$key]['Дата_приёма'] = (new DateTime($table[$key]['Дата_приёма']))->format('d.m.Y'); }
			if ($table[$key]['ИД_Персонал']) { $table[$key]['ИД_Персонал'] =  $table[$key]['ИД_Персонал'][0]; }
		}
		$stmt = null;
		return $table;
	}

}