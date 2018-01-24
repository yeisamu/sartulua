<?php
error_reporting(0);
//sleep(3);
session_start();
//check if something is posted and is not blank
if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
	//store the username and password in the respective variables
	$username = htmlentities(trim($_POST['username']),ENT_QUOTES);
	$password = htmlentities(trim($_POST['password']),ENT_QUOTES);
	$con=md5($password);
	//check for the valid username and password
	include('../inc/libreria.php');
      $link=conectarse();
       $consulta = "select * from acc_usuario where login='$username' and clave='$con'";
        $resultado=mysql_query($consulta);
		$numregistros=mysql_num_rows($resultado);
		$fila=mysql_fetch_array($resultado);
	if($numregistros>0)
	 {
		 //create the session variables
		         $_SESSION['login'] = $username;
		 		$_SESSION['pass'] = $con;
				$_SESSION['id_usr'] = $fila['id_usr'];
				$_SESSION['control'] =1;
				$_SESSION['loggedIn'] = true;
				$msg = '<font color="077302">Login Acceptado.</font><script type="text/javascript">window.location = "index2.php";</script>';
	}else{
		//username and password is not valid
		echo $msg = "Usuario no valido .!";
	}
		 
}else{
	//username and/or password is blank
	$msg = "Debe introducir Usuario y Password.";;
}
//echo the result
echo $msg;
?>
