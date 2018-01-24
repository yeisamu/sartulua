<?php
session_start();

include('../inc/libreria.php');
     $link=conectarse();
//check if something is posted and is not blank
if(isset($_REQUEST['logina']) && !empty($_REQUEST['logina']) && isset($_REQUEST['passa']) && !empty($_REQUEST['passa'])){
	//store the username and password in the respective variables
	$username = htmlentities(trim($_REQUEST['logina']),ENT_QUOTES);
	$password = htmlentities(trim($_REQUEST['passa']),ENT_QUOTES);
	$con=md5($password);
	//check for the valid username and password
       $consulta = "select * from acc_usuario where login='$username' and clave='$con' and admin=1";
        $resultado=mysql_query($consulta);
		$numregistros=mysql_num_rows($resultado);
		$fila=mysql_fetch_array($resultado);
	if($numregistros>0)
	 {
		 //create the session variables
		      $msg = "<font color='077302'>Login Acceptado.</font><script type='text/javascript'>document.getElementById('grabaimp').disabled=false;jQuery('#autoriza').dialog( 'close' );</script>";
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
