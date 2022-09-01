<?php 

// Вход
class Login extends Dbh {

	private function checkDr($uid) {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Водитель WHERE ИД_Персонал = ?');
		$stmt->execute(array($uid));
		return ($stmt->rowCount() != 0);

	}

	private function checkMec($uid) {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Механик WHERE ИД_Персонал = ?');
		$stmt->execute(array($uid));
		return ($stmt->rowCount() != 0);
	}

	private function checkDisp($uid) {
		$stmt = Dbh::connect()->prepare('SELECT * FROM Диспетчер WHERE ИД_Персонал = ?');
		$stmt->execute(array($uid));
		return ($stmt->rowCount() != 0);
	}

	protected function getUser($uid, $pwd) {

		$stmt = Dbh::connect()->prepare('SELECT * FROM Пароли WHERE ИД_Персонал = ?');

		if (!$stmt->execute(array($uid))) {
			$stmt = null;
			print "Stmt failed!<br/>";
			exit();
		}

		if($stmt->rowCount() == 0) {
			$stmt = null;
			header("location: ../index.php?error=wrongidorpassword");
			exit();
		}

		$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if(!password_verify($pwd, $user[0]['Пароль'])) {
			$stmt = null;
			header("location: ../index.php?error=wrongidorpassword");
			exit();
		}
		else {
			$pos = "v4";
			if ($this->checkDr($uid)) {
				$pos = "v1";
			} elseif ($this->checkMec($uid)) {
				$pos = "v2";
			} elseif ($this->checkDisp($uid)) {
				$pos = "v3";
			}
			session_start();
			$_SESSION['user']['login'] = $user[0]['ИД_Персонал'];
			$_SESSION['user']['position'] = $pos;
		}
		$stmt = null;
	}

}