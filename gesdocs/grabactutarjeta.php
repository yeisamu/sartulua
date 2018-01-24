<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
		$link=conectarse();
 $login=$_SESSION['login'];
 
 $fechact=deme_now();
 //date("Y-m-d h:i:s");
 $ntarjeta=$_REQUEST['id_tarj'];
  $movil=$_REQUEST['movil'];
 $fecha_ant=$_REQUEST['fecha_ant'];
 $fnew=$_REQUEST['fnew'];
 $id_cond=$_REQUEST['id_cond'];
 $docguia=$_REQUEST['docguia'];
 $id_tran=2;
  $fecha_corte=aumenta_dias($fnew,1);
  
 // $actu_novedad=mysql_query("update novedad_diario set control=0 where id_movil='$movil'");
  
  
  
 $insertcomp="insert into `comprobante` (`fecha_ante`,`fecha_nu`, `id_conductor`, `usuario`, `fecha_alavo`, `id_comprobante`, `id_tran`,observaciones) values ('$fecha_ant','$fnew','$id_cond','$login','$fechact','$ntarjeta','$id_tran','$docguia') ";
$sqltar=mysql_query($insertcomp);

$actu="update tarjeta_control set fecha_vigencia='$fnew',fecha_plazo_a='$fecha_corte' where id_tarjeta='$ntarjeta'";
$sqlactu=mysql_query($actu);
	if(!$sqltar || !$sqlactu ){
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>document.getElementById('grabaimp').disabled=true;jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Grabar Tarjeta de Control'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Tarjeta de control Nº $ntarjeta   Actualizada con exito </div><script language='javascript'>
	    jQuery('#crudnov').trigger('reloadGrid');
		 jQuery('#crudtc').trigger('reloadGrid');
	   document.getElementById('grabaimp').disabled=true;jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#actualizatc').dialog( 'close' );}}});</script>";
	}	
				
?>

