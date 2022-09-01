<?php 

class checkTicket extends Dbh {

	public function getTicket() {
		$stmt = Dbh::connect()->prepare("SELECT * FROM Проездной_билет WHERE id = ?");
		if (!$stmt->execute(array($this->uid))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}

		if ($stmt->rowCount() == 0) {
			echo "не нашлось карточек";
			$stmt = null;
			return false;
		}

		$ticket = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if ($this->pwd != $ticket[0]['Пароль']) {
			$stmt = null;
			return false;
		}

		// if (!password_verify($this->pwd, $ticket[0]['Пароль'])) {
		// 	$stmt = null;
		// 	return false;
		// }
		else {
			$stmt = null;
			return $ticket;
		}

	}

	public function writeOff() {
		$stmt = Dbh::connect()->prepare("SELECT * FROM Проездной_билет WHERE id = ? AND Поездки > 0");
		if (!$stmt->execute(array($this->uid))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}

		if ($stmt->rowCount() == 0) {
			$stmt = null;
			return false;
		}

		$stmt1 = Dbh::connect()->prepare("UPDATE Проездной_билет SET Поездки = Поездки - 1 WHERE id = ?");
		if (!$stmt1->execute(array($this->uid))) {
			$stmt1 = null;
			print "Stmt failed!<br/>";
			exit();
		}

		$my_date = date('Y-d-m H:i:s');

		$stmt2 = Dbh::connect()->prepare("INSERT INTO Поездка (ИД_проездной, Способ_оплаты, Дата_время, ИД_рейс) VALUES (?, 'Проездной', ?, ?)");
		if (!$stmt2->execute(array($this->uid, $my_date, $this->flight))) {
			$stmt2 = null;
			print "Stmt failed!<br/>";
			exit();
		}

		return true;
	}
	

}