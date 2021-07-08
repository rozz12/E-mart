<?php
	include('connection.php');
	session_start();
	if (!isset($_SESSION['userid'])) {
		header('Location: ../Homepage.php');
	}
	session_destroy();
	header('Location: ../Homepage.php');
?>