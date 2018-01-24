<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
		$link=conectarse();
		
 $login=$_SESSION['login'];
 $fechact=date("Y-m-d h:i:s");
 $fechadpago=$_REQUEST['fechapago'];
 $fecha_ant_parte=$_REQUEST['fecha_ant_parte'];
  $id_simit=$_REQUEST['id_simit'];
  $obser=$_REQUEST['obsimit'];
 $id_tran=8;
 echo $consimit=mysql_query("update `simit` set `fecha_pago`='$fechadpago', `estado`=2 where id_simit=$id_simit");
 
  $insertcomp="insert into `comprobante` (fecha_ante,`fecha_nu`, `usuario`, `fecha_alavo`, `id_comprobante`, `id_tran`,`observaciones`) values ('$fecha_ant_parte','$fechadpago','$login','$fechact',$id_simit,'$id_tran','$obser') ";
	$sqlcomp=mysql_query($insertcomp);
	
	if(!$consimit || !$sqlcomp ){
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#pagamultas').dialog( 'close' );}}});</script>";

	}else{
?>	
<div class='ui-state-error' id='errorgraba' title='Actualizacion de Pago de Comparendo'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Comparendo  Actualizado con exito </div><script language='javascript'>
	  
		jQuery('#crudsim').jqGrid('setCaption','Detalle de Comparendo') .trigger('reloadGrid');
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#pagamultas').dialog( 'close' );}}});</script>
	
	<?php
	}	
		?>		

