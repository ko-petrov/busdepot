<?php

class Dbh {

	static protected function connect() {
		try {
			$dsn = "sqlsrv:Server=DESKTOP-2ETHJV2;Database=Парк5";
			$username = "";
			$password = "";
			$options = array("CharacterSet" => "UTF-8");
			$dbh = new PDO($dsn, $username, $password, $options);
			return $dbh;
		}
		catch (PDO_Exception $e) {
			print "Error!: " . $e->getMessage() . "<br/>";

		}
	}

}