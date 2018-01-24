<?php
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		$link=conectarse();
		$fechact=date("Y-m-d h:i:s");
		$usuario=$_SESSION['login'];
$id_tarjeta=$_REQUEST['id_tarjeta'];
$datos=mysql_query("select vehiculo.id_movil,placa,conductor.id_conductor,codigo,concat(nombre1,' ',nombre2,' ',apellido1,' ',apellido2) as nombres from (tarjeta_control inner join vehiculo on tarjeta_control.id_movil=vehiculo.id_movil) inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor where id_tarjeta=$id_tarjeta");
$filad=mysql_fetch_array($datos);

$id_movil=$filad['id_movil'];
$placa=$filad['placa'];
$id_conductor=$filad['id_conductor'];
$codigo=$filad['codigo'];
$nombres=$filad['nombres'];
$tarjeta=$filad['tarjeta'];

$compro=mysql_query("insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`, `placa`, `id_conductor`, `codigo`, `nombres`, `id_tarjeta`, `tarjeta`, `id_tran`) values ('$fechact','$usuario','$id_movil','$placa',$id_conductor,'$codigo','$nombres',$id_tarjeta,'$tarjeta',13)");
echo $var="delete from `frecuencia` where id_movil='$id_movil'";
$frec=mysql_query("delete from `frecuencia` where id_movil='$id_movil'");



	if(!$compro || !$datos || !$frec){
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	echo $modal="
<script language='javascript'>
	    jQuery('#crudfre').trigger('reloadGrid');jQuery('#crudac').trigger('reloadGrid');
	   </script>";
	}	
/*<div class='ui-state-error' id='errorgraba' title='Grabar Reporte de Frecuencia'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Cierre de Frecuencia del Movil $id_movil Grabado con exito </div>
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#frecuencia').dialog( 'close' );}}});				
*/?>
