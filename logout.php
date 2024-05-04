<?php
	require_once 'inc/utils.php';
		session_destroy();
		header("Location: login.php");

	if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		header("Location: login.php");
		exit;
	}	