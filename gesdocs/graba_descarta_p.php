<?php
session_start();

include('../inc/libreria.php');
     $link=conectarse();
//check if something is posted and is not blank
if(isset($_REQUEST['loginan']) && !empty($_REQUEST['loginan']) && isset($_REQUEST['passan']) && !empty($_REQUEST['passan'])){
	//store the username and password in the respective variables
	$username = htmlentities(trim($_REQUEST['loginan']),ENT_QUOTES);
	$password = htmlentities(trim($_REQUEST['passan']),ENT_QUOTES);
	//$fecha_ant=$_REQUEST['fvigencia'];
	// $fnew=$_REQUEST['fauto'];
	//$hnew=$_REQUEST['hauto'];
	// $fgraba=date("Y-m-d H:i",strtotime($fnew));
	//$fechact=date("Y-m-d h:i:s");
	//$ntarjeta=$_REQUEST['n_tarj'];
	 $id_tran=7;
	
	
	$con=md5($password);
	//check for the valid username and password
      $consulta = "select * from acc_usuario where login='$username' and clave='$con' and admin=1";
        $resultado=mysql_query($consulta);
		$numregistros=mysql_num_rows($resultado);
		$fila=mysql_fetch_array($resultado);
		
	if($numregistros>0)
	 {
		 //create the session variables
		 
$login=$_SESSION['login'];
 $fechact=date("Y-m-d h:i:s");
 $numplanilla=$_REQUEST['numplanilla'];
 $id_planilla=$_REQUEST['id_planilla'];
 $obs=$_REQUEST['observaciones_p'];
 //$fnew=date("Y-m-d");
 $id_tran=10;
 $insertcomp="insert into `comprobante` (`usuario`, `fecha_alavo`, `id_comprobante`, `id_tran`,`observaciones`) values ('$login','$fechact','$id_planilla','$id_tran','$obs') ";
$sqltar=mysql_query($insertcomp);

$actutar="delete from planilla  where id_planilla=$id_planilla";
$querytar=mysql_query($actutar);

$borrarp="update reporte_planilla  set `fecha`='0000-00-00 00:00:00',`id_movil`=' ', `id_conductor`=' ', `codigo`=' ', `nombre_con`=' ', `destino`=' ', `elab`=' ', `recibido`=' ', `estado`=' ', `observaciones`=' ', `liquidado`=' ' where id_planilla=$id_planilla";
$queryborrar=mysql_query($borrarp);
	if(!$sqltar || !$querytar || !$queryborrar){
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#descarta_planilla').dialog( 'close' );	}}});</script>";

	}else{
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Modificar Planilla'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Planilla de Viaje Ocasional Nº $numplanilla  Modificada con exito </div><script language='javascript'>
	    jQuery('#crudtc').trigger('reloadGrid');
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#descarta_planilla').dialog( 'close' );}}});</script>";
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
