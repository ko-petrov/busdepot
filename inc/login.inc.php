<?php

if(isset($_POST['submit'])) {

	$uid = $_POST['login'];
	$pwd = $_POST['password'];

	include("../classes/dbh.classes.php");
	include("../classes/login.classes.php");
	include("../classes/login-contr.classes.php");
	
	$login = new LoginContr($uid, $pwd);
	$login->loginUser();

	header("location: ../index.php");
}