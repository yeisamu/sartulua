<?php
session_start();
date_default_timezone_set('UTC'); 
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		$link=conectarse();
	
		$usuario=$_SESSION['login'];

$id_serv=$_REQUEST['id_serv'];
$obs=$_REQUEST['obs'];

		 $datosv=mysql_query("select * from servicio where id_ser=$id_serv");
$filad=mysql_fetch_array($datosv);

$id_movil=$filad['id_movil'];
$placa=$filad['placa'];
$id_conductor=$filad['id_conductor'];
$codigo=$filad['codigo'];
$nombres=$filad['nombres'];
$tarjeta=$filad['tarjeta'];
$id_tarjeta=$filad['id_tarjeta'];


$compro=mysql_query("insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`, `placa`, `id_conductor`, `codigo`, `nombres`, `id_tarjeta`, `tarjeta`, `id_tran`) values (now(),'$usuario','$id_movil','$placa',$id_conductor,'$codigo','$nombres',$id_tarjeta,'$tarjeta',17)");

$frec=mysql_query("update servicio set estado=2,observacion='$obs' where id_ser=$id_serv");


	if(!$compro || !$frec){
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	echo $modal="
<script language='javascript'>
	 ser_asig('Layer6');actualizatabla('Layer5');jQuery('#descarte').dialog('close');</script>";
	}	
				
?>
