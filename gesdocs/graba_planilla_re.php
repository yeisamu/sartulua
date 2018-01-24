<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db

		$link=conectarse();
 $login=$_SESSION['login'];
 $fechact=date("Y-m-d h:i:s");
 $numplanilla=$_REQUEST['numplanilla'];
 $id_planilla=$_REQUEST['id_planilla'];
 $obs=$_REQUEST['observaciones_p'];
 //$fnew=date("Y-m-d");
 $id_tran=5;
 $insertcomp="insert into `comprobante` (`usuario`, `fecha_alavo`, `id_comprobante`, `id_tran`,`observaciones`) values ('$login','$fechact','$id_planilla','$id_tran','$obs') ";
$sqltar=mysql_query($insertcomp);

$actutar="update planilla set estado=2,usr_rec='$login',fecha_dev='$fechact',est_ant=1 where id_planilla=$id_planilla";
$querytar=mysql_query($actutar);

	if(!$sqltar || !$querytar){
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#recibe_planilla').dialog( 'close' );	}}});</script>";

	}else{
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Grabar Recibido de Planilla'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Planilla de Viaje Ocasional Nº $numplanilla  Recibida con exito </div><script language='javascript'>
	    jQuery('#crudplan').trigger('reloadGrid');jQuery('#crudplancon').trigger('reloadGrid');
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#recibe_planilla').dialog( 'close' );}}});</script>";
	}	
				
?>

