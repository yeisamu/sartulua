<?php
	session_start();
				unset($_SESSION['loggedIn']);
				session_destroy();
	include_once 'loginchecker.php';
?>