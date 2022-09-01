<?php 

// Остановки
class Stops extends Dbh {

	static public function getStops() {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Остановка');
		if (!$stmt->execute()) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		return $table;
	}

	static public function getProgress($id_route, $progress) {
		
		$stmt = Dbh::connect()->prepare('SELECT Остановка.Название, Остановка_Маршрут.Порядок  FROM Остановка_Маршрут
											INNER JOIN Остановка ON Остановка_Маршрут.ИД_остановка = Остановка.ИД_остановка
										 WHERE ИД_маршрут = ? AND Порядок >= ? ORDER BY Остановка_Маршрут.Порядок');
		if (!$stmt->execute(array($id_route, $progress))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		return $table;
	}

}