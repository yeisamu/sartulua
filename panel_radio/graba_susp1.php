<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexi�n a la db
		$link=conectarse();
		$fechact=date("Y-m-d h:i:s");
		$usuario=$_SESSION['login'];
$id_tarjeta=$_REQUEST['id_tarjeta'];

$f_inic=$_REQUEST['f_inicio'];
$f_inicio=date("Y-m-d H:i",strtotime($f_inic));
$f_fin=$_REQUEST['f_fin'];
$fecha_fin=date("Y-m-d H:i",strtotime($f_fin));

$motivo=$_REQUEST['motivo'];
$datos=mysql_query("select vehiculo.id_movil,placa,conductor.id_conductor,codigo,concat(nombre1,' ',nombre2,' ',apellido1,' ',apellido2) as nombres from (tarjeta_control inner join vehiculo on tarjeta_control.id_movil=vehiculo.id_movil) inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor where id_tarjeta=$id_tarjeta");
$filad=mysql_fetch_array($datos);

$id_movil=$filad['id_movil'];
$placa=$filad['placa'];
$id_conductor=$filad['id_conductor'];
$codigo=$filad['codigo'];
$nombres=$filad['nombres'];
$tarjeta=$filad['tarjeta'];
$id_conductor=$filad['id_conductor'];

$compro=mysql_query("insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`, `placa`, `id_conductor`, `codigo`, `nombres`, `id_tarjeta`, `tarjeta`, `id_tran`) values ('$fechact','$usuario','$id_movil','$placa',$id_conductor,'$codigo','$nombres',$id_tarjeta,'$tarjeta',14)");

$frec=mysql_query("insert into `suspension` (`id_movil`, `f_inicio`, `f_fin`, `descripcion`, `usuario`,est,`id_tarjeta`, `id_conductor`, `conductor`)values('$id_movil','$f_inicio','$fecha_fin','$motivo','$usuario',1,$id_tarjeta,$id_conductor,'$nombres')");

$bajactivo=mysql_query("delete from  `frecuencia` where id_movil='$id_movil'");


	if(!$compro || !$datos || !$frec || !$bajactivo){
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Grabar Reporte de Frecuencia'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Se Suspendio (10-7) el Movil  $id_movil con exito </div><script language='javascript'>
	    jQuery('#crudsus').trigger('reloadGrid');jQuery('#crudfre').trigger('reloadGrid');
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#suspende').dialog( 'close' );}}});</script>";
	}	
				
?>
