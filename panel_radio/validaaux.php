<?php
session_start();
//check if something is posted and is not blank
if(isset($_REQUEST['aux']) && !empty($_REQUEST['aux']) && isset($_REQUEST['pasaux']) && !empty($_REQUEST['pasaux'])){
	//store the username and password in the respective variables
	$username = htmlentities(trim($_REQUEST['aux']),ENT_QUOTES);
	$password = htmlentities(trim($_REQUEST['pasaux']),ENT_QUOTES);
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
		         $_SESSION['loginaux'] = $username;
				 // $_SESSION['login'] = $_SESSION['login']."-". $_SESSION['loginaux'];
		 		$_SESSION['pasaux'] = $con;
				$_SESSION['id_usraux'] = $fila['id_usr'];
				$_SESSION['loggedIn'] = true;
				$msg = '<font color="077302">Login Acceptado.</font><script type="text/javascript">l_aux("Layer12")/*window.location = "index2.php";*/</script>';
	}else{
		//username and password is not valid
		 $msg = "<font color='FF0000'>Usuario no valido .!</font>";
	}
		 
}else{
	//username and/or password is blank
	$msg = "<font color='FF0000'>Debe introducir Usuario y Password.</font>";;
}
//echo the result
echo $msg;
?>
