<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db

		$link=conectarse();
 $login=$_SESSION['login'];
 $fechact=date("Y-m-d h:i:s");
 $ntarjeta=$_REQUEST['id_tarj'];
 $id_cond=$_REQUEST['doc'];
 $obs=$_REQUEST['observaciones'];
 $fnew=date("Y-m-d");
 $id_tran=3;
 $insertcomp="insert into `comprobante` (`fecha_nu`, `id_conductor`, `usuario`, `fecha_alavo`, `id_comprobante`, `id_tran`,`observaciones`) values ('$fnew','$id_cond','$login','$fechact','$ntarjeta','$id_tran','$obs') ";
$sqltar=mysql_query($insertcomp);

$actutar="update tarjeta_control set estado=2 where id_tarjeta=$ntarjeta";
$querytar=mysql_query($actutar);

	if(!$sqltar || !$querytar){
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>document.getElementById('grabarcierre').disabled=true;jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Grabar Tarjeta de Control'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Tarjeta de control Nº $ntarjeta  Cerrada con exito </div><script language='javascript'>
	    jQuery('#crudtc').jqGrid('setCaption','Detalle de tarjetas de control') .trigger('reloadGrid');
	   document.getElementById('grabarcierre').disabled=true;jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#cerrar').dialog( 'close' );}}});</script>";
	}	
				
?>

