<?php
	session_start();
				unset($_SESSION['loginaux']);
				//session_destroy();
	//include_once 'loginchecker.php';
echo 	$msg = '<font color="077302">Login Cerrado.</font><script type="text/javascript">login_aux("Layer12")/*window.location = "index2.php";*/</script>';
	
?>