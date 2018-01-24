<?php
session_start();

include('../inc/libreria.php');
     $link=conectarse();
//check if something is posted and is not blank
if(isset($_REQUEST['loginauto']) && !empty($_REQUEST['loginauto']) && isset($_REQUEST['passauto']) && !empty($_REQUEST['passauto'])){
	//store the username and password in the respective variables
	$username = htmlentities(trim($_REQUEST['loginauto']),ENT_QUOTES);
	$password = htmlentities(trim($_REQUEST['passauto']),ENT_QUOTES);
	$n_simit=$_REQUEST['n_simit'];
	 $id_tran=9;
	
	
	$con=md5($password);
	//check for the valid username and password
      $consulta = "select * from acc_usuario where login='$username' and clave='$con' and admin=1";
        $resultado=mysql_query($consulta);
		$numregistros=mysql_num_rows($resultado);
		$fila=mysql_fetch_array($resultado);
		
	if($numregistros>0)
	 {
		 //create the session variables
		 
		  $insertcomp="insert into `comprobante` (`usuario`, `fecha_alavo`, `id_comprobante`, `id_tran`) values ('$username','$fechact','$n_simit','$id_tran') ";
$sqltar=mysql_query($insertcomp);

 $actu="DELETE FROM `simit` WHERE `simit`.`id_simit` = $n_simit";
$sqlactu=mysql_query($actu);
if(!$sqltar || !$sqlactu ){
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Anular Registro de Multa'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Registro Cerrado con exito  </div><script language='javascript'>
	    jQuery('#crudsim').jqGrid('setCaption','Detalle de Comparendo') .trigger('reloadGrid');
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#cierramultas').dialog( 'close' );}}});</script>";
	}	
	
		  
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
