<?php
session_start();
date_default_timezone_set('UTC'); 
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		$link=conectarse();
		$fechact=date("Y-m-d h:i:s");
		$usuario=$_SESSION['login'];
$id_tarjeta=$_REQUEST['id_tarjeta'];
$f_inic=$_REQUEST['f_inicio'];

$diracc=$_REQUEST['diracc'];
$id_tipo_a=$_REQUEST['id_tipo_a'];
$placa_otro=$_REQUEST['placa_otro'];
$info_otro=$_REQUEST['info_otro'];
$entidad=$_REQUEST['entidad'];
$prop=$_REQUEST['prop'];
$amb=$_REQUEST['amb'];
$les=$_REQUEST['les'];
$tras=$_REQUEST['tras'];
$transito=$_REQUEST['transito'];
$inforep=$_REQUEST['inforep'];
$fecha_inc=date("Y-m-d H:i",strtotime($f_inic));

		 $datosv=mysql_query("select vehiculo.id_movil,placa,conductor.id_conductor,codigo,concat(nombre1,' ',nombre2,' ',apellido1,' ',apellido2) as nombres,marca from (tarjeta_control inner join (vehiculo inner join marca on vehiculo.id_marca=marca.id_marca) on tarjeta_control.id_movil=vehiculo.id_movil) inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor where id_tarjeta=$id_tarjeta");
$filad=mysql_fetch_array($datosv);

$id_movil=$filad['id_movil'];
$placa=$filad['placa'];
$id_conductor=$filad['id_conductor'];
$marca=$filad['marca'];
$codigo=$filad['codigo'];
$nombres=$filad['nombres'];
$tarjeta=$filad['tarjeta'];
$conacc=mysql_query("select * from tipo_accidente where id_tipo_a=$id_tipo_a");
$datoacc=mysql_fetch_array($conacc);
$tipo_acc=$datoacc['tipo_accidente'];

$datos=mysql_query("select vehiculo.id_movil,placa,conductor.id_conductor,codigo,concat(nombre1,' ',nombre2,' ',apellido1,' ',apellido2) as nombres,tarjeta from (tarjeta_control inner join vehiculo on tarjeta_control.id_movil=vehiculo.id_movil) inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor where id_tarjeta=$id_tarjeta");
$filad=mysql_fetch_array($datos);

$id_movil=$filad['id_movil'];
$placa=$filad['placa'];
$id_conductor=$filad['id_conductor'];
$codigo=$filad['codigo'];
$nombres=$filad['nombres'];
$tarjeta=$filad['tarjeta'];

$compro=mysql_query("insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`, `placa`, `id_conductor`, `codigo`, `nombres`, `id_tarjeta`, `tarjeta`, `id_tran`) values ('$fechact','$usuario','$id_movil','$placa',$id_conductor,'$codigo','$nombres',$id_tarjeta,'$tarjeta',15)");

$frec=mysql_query("insert into `accidente` (`fecha`, `usuario`, `fecha_inc`, `dir_inc`, `id_tarjeta`, `tarjeta`, `id_conductor`, `codigo`, `nombres`, `id_movil`, `placa`, `placa_otro`, `info_otro`, `id_tipo_a`,tipo_accidente,reportado,`conduce_prop`, `ambulancia`, `lesionado`, `transito`, `tras_lesionado`, `entidad_lesionado`) values(now(),'$usuario','$fecha_inc','$diracc','$id_tarjeta','$tarjeta','$id_conductor','$codigo','$nombres','$id_movil','$placa','$placa_otro','$info_otro','$id_tipo_a','$tipo_acc','$inforep','$prop','$amb','$les','$transito','$tras','$entidad')");



	if(!$compro || !$datos || !$frec || !$datosv){
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos</div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Grabar Reporte de 10-42'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Se Reporto (10-42) el Movil  $id_movil con exito </div><script language='javascript'>
	  // jQuery('#crudsus').trigger('reloadGrid');jQuery('#crudfre').trigger('reloadGrid');
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#accidente').dialog( 'close' );}}});</script>";
	}	
				
?>
